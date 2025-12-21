<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MidtransService
{
  public function __construct()
  {
    $this->setupConfig();
  }

  private function setupConfig()
  {
    Config::$serverKey = config('services.midtrans.server_key');
    Config::$clientKey = config('services.midtrans.client_key');
    Config::$isProduction = config('services.midtrans.is_production');
    Config::$isSanitized = config('services.midtrans.is_sanitized');
    Config::$is3ds = config('services.midtrans.is_3ds');
  }

  public function createTransaction(Pesanan $pesanan)
  {
    $finishUrl = route('pembayaran.finish', ['kode' => $pesanan->kode_pesanan]);
    $errorUrl = route('pembayaran.error', ['kode' => $pesanan->kode_pesanan]);
    $pendingUrl = route('pembayaran.pending', ['kode' => $pesanan->kode_pesanan]);

    $params = [
      'transaction_details' => [
        'order_id' => $pesanan->kode_pesanan,
        'gross_amount' => (float) $pesanan->total_harga,
      ],
      'customer_details' => [
        'first_name' => $pesanan->nama_penerima ?? 'Customer',
        'email' => $pesanan->email_penerima ?? 'customer@example.com',
        'phone' => $pesanan->telepon_penerima ?? '081234567890',
        'billing_address' => [
          'first_name' => $pesanan->nama_penerima ?? 'Customer',
          'email' => $pesanan->email_penerima ?? 'customer@example.com',
          'phone' => $pesanan->telepon_penerima ?? '081234567890',
          'address' => $pesanan->alamat_pengiriman ?? '-',
          'city' => $pesanan->kota ?? '-',
          'postal_code' => $pesanan->kode_pos ?? '-',
        ],
        'shipping_address' => [
          'first_name' => $pesanan->nama_penerima ?? 'Customer',
          'email' => $pesanan->email_penerima ?? 'customer@example.com',
          'phone' => $pesanan->telepon_penerima ?? '081234567890',
          'address' => $pesanan->alamat_pengiriman ?? '-',
          'city' => $pesanan->kota ?? '-',
          'postal_code' => $pesanan->kode_pos ?? '-',
        ]
      ],
      'expiry' => [
        'start_time' => date('Y-m-d H:i:s O'),
        'unit' => 'hours',
        'duration' => 24
      ],
      'callbacks' => [
        'finish' => $finishUrl,
        'error' => $errorUrl,
        'pending' => $pendingUrl
      ]
    ];

    if ($pesanan->items()->exists()) {
      $params['item_details'] = $this->getItemDetails($pesanan);
    }
    $enabledPayments = config('services.midtrans.enabled_payments');
    if ($enabledPayments) {
      $params['enabled_payments'] = explode(',', $enabledPayments);
    }
    try {
      $snapToken = Snap::getSnapToken($params);
      return $snapToken;
    } catch (\Exception $e) {
      throw new \Exception('Gagal membuat transaksi Midtrans: ' . $e->getMessage());
    }
  }

  private function getItemDetails(Pesanan $pesanan)
  {
    $items = [];

    $pesanan->load(['items.produkUkuran.produk', 'items.produkUkuran.ukuran']);

    foreach ($pesanan->items as $item) {
      $produkName = $item->produkUkuran->produk->nama ?? 'Produk';
      $ukuranName = $item->produkUkuran->ukuran->nama_ukuran ?? '';

      $items[] = [
        'id' => $item->id_produk_ukuran ?? 'item-' . $item->id,
        'price' => (float) $item->harga_satuan,
        'quantity' => (int) $item->kuantitas,
        'name' => trim($produkName . ' ' . $ukuranName),
      ];
    }

    if ($pesanan->pajak > 0) {
      $items[] = [
        'id' => 'tax',
        'price' => (float) $pesanan->pajak,
        'quantity' => 1,
        'name' => 'Pajak',
      ];
    }

    return $items;
  }

  public function handleNotification(Request $request)
  {
    // CEK APAKAH REQUEST INI DUPLICATE DENGAN LOCK
    $requestSignature = md5($request->getContent() . $request->ip() . now()->format('Y-m-d H:i'));
    $cacheKey = 'midtrans_req_' . $requestSignature;

    if (cache()->has($cacheKey)) {
      Log::warning('Duplicate request detected', [
        'signature' => $requestSignature,
        'ip' => $request->ip()
      ]);
      return ['status' => 'ignored', 'message' => 'Duplicate request'];
    }

    // Lock request ini untuk 30 detik
    cache()->put($cacheKey, true, 30);

    try {
      $notification = new Notification();
      $orderId = $notification->order_id;
      $transactionId = $notification->transaction_id;
      $transactionStatus = $notification->transaction_status;

      // CEK APAKAH TRANSAKSI INI SUDAH DIPROSES DENGAN STATUS YANG SAMA
      $existingLog = DB::table('midtrans_notification_logs')
        ->where('transaction_id', $transactionId)
        ->where('status', $transactionStatus)
        ->first();

      if ($existingLog) {
        cache()->forget($cacheKey);
        return ['status' => 'ignored', 'message' => 'Already processed'];
      }

      $pesanan = Pesanan::where('kode_pesanan', $orderId)->first();
      if (!$pesanan) {
        Log::error('Pesanan not found', ['order_id' => $orderId]);
        cache()->forget($cacheKey);
        return ['status' => 'error', 'message' => 'Pesanan tidak ditemukan'];
      }

      // Mapping status
      $statusMap = [
        'capture' => 'dibayar',
        'settlement' => 'dibayar',
        'pending' => 'menunggu',
        'deny' => 'dibatalkan',
        'expire' => 'dibatalkan',
        'cancel' => 'dibatalkan',
      ];

      $fraudStatus = $notification->fraud_status ?? null;
      $paymentType = $notification->payment_type ?? null;

      $newStatus = ($transactionStatus == 'capture' && $paymentType == 'credit_card')
        ? (($fraudStatus == 'challenge') ? 'menunggu' : 'dibayar')
        : ($statusMap[$transactionStatus] ?? 'menunggu');

      // Cek apakah stock sudah diupdate
      $shouldUpdateStock = false;

      // HANYA update stock jika status settlement/capture DAN belum diupdate
      if (in_array($transactionStatus, ['settlement', 'capture']) && $pesanan->stock_updated_at === null) {
        $shouldUpdateStock = true;

        // LOCK PESANAN untuk menghindari race condition
        DB::beginTransaction();
        try {
          $lockedPesanan = Pesanan::where('id_pesanan', $pesanan->id_pesanan)
            ->lockForUpdate()
            ->first();

          // Double check setelah lock
          if ($lockedPesanan->stock_updated_at === null) {
            $updateSuccess = $this->updateStockAfterPayment($lockedPesanan);
            $shouldUpdateStock = $updateSuccess;
          } else {
            $shouldUpdateStock = false;
          }

          DB::commit();
        } catch (\Exception $e) {
          DB::rollBack();
          Log::error('Transaction error:', ['error' => $e->getMessage()]);
          $shouldUpdateStock = false;
        }
      }

      // Update pesanan status jika perlu
      $currentStatus = $pesanan->status;
      if ($newStatus !== $currentStatus) {
        $pesanan->status = $newStatus;
        $pesanan->last_notification_id = $transactionId;

        // Update metode pembayaran jika ada
        $bankName = $this->getPaymentMethod($notification);
        if ($bankName) {
          $pesanan->metode_pembayaran = $bankName;
        } elseif ($paymentType) {
          $pesanan->metode_pembayaran = $paymentType;
        }

        $pesanan->save();
      }

      // Simpan log notification UNTUK STATUS INI
      try {
        DB::table('midtrans_notification_logs')->insert([
          'transaction_id' => $transactionId,
          'status' => $transactionStatus,
          'order_id' => $orderId,
          'payload' => json_encode($notification->getResponse()),
          'processed_at' => now(),
          'created_at' => now(),
          'updated_at' => now()
        ]);
      } catch (\Exception $e) {
        Log::error('Failed to save notification log:', ['error' => $e->getMessage()]);
      }

      cache()->forget($cacheKey);

      return [
        'status' => 'success',
        'transaction_status' => $transactionStatus,
        'order_id' => $orderId,
        'pesanan_status' => $newStatus,
        'stock_updated' => $shouldUpdateStock
      ];
    } catch (\Exception $e) {
      cache()->forget($cacheKey);
      Log::error('Midtrans notification error:', [
        'error' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
      ]);
      return ['status' => 'error', 'message' => $e->getMessage()];
    }
  }

  private function getPaymentMethod($notification)
  {
    $paymentType = $notification->payment_type ?? null;

    if ($paymentType == 'bank_transfer' && !empty($notification->va_numbers)) {
      return $notification->va_numbers[0]->bank ?? null;
    }

    $paymentMethods = [
      'qris' => 'QRIS',
      'gopay' => 'GoPay',
      'shopeepay' => 'ShopeePay',
    ];

    return $paymentMethods[$paymentType] ?? $paymentType;
  }

  private function updateStockAfterPayment(Pesanan $pesanan)
  {
    return DB::transaction(function () use ($pesanan) {
      // LOCK dan ambil pesanan dengan kondisi strict
      $lockedPesanan = Pesanan::where('id_pesanan', $pesanan->id_pesanan)
        ->whereNull('stock_updated_at')
        ->lockForUpdate()
        ->first();

      if (!$lockedPesanan) {
        return false;
      }

      // Ambil items
      $items = DB::table('pesanan_item as pi')
        ->join('produk_ukuran as pu', 'pi.id_produk_ukuran', '=', 'pu.id_produk_ukuran')
        ->where('pi.id_pesanan', $lockedPesanan->id_pesanan)
        ->select('pi.id_produk_ukuran', 'pi.kuantitas', 'pu.id_produk')
        ->lockForUpdate()
        ->get();

      foreach ($items as $item) {
        // Update stok
        $stokUpdated = DB::table('produk_ukuran')
          ->where('id_produk_ukuran', $item->id_produk_ukuran)
          ->where('stok', '>=', $item->kuantitas)
          ->decrement('stok', $item->kuantitas);

        if ($stokUpdated !== 1) {
          Log::error('Failed to update stock', ['id_produk_ukuran' => $item->id_produk_ukuran]);
          throw new \Exception('Stock update failed');
        }

        // Update terjual
        $terjualUpdated = DB::table('produk')
          ->where('id_produk', $item->id_produk)
          ->increment('terjual', $item->kuantitas);

        if ($terjualUpdated !== 1) {
          Log::error('Failed to update terjual', ['id_produk' => $item->id_produk]);
          throw new \Exception('Terjual update failed');
        }
      }

      // Update timestamp - ini SATU-SATUNYA tempat update stock_updated_at
      $updated = DB::table('pesanan')
        ->where('id_pesanan', $lockedPesanan->id_pesanan)
        ->whereNull('stock_updated_at')
        ->update(['stock_updated_at' => now()]);

      if ($updated !== 1) {
        throw new \Exception('Failed to update stock timestamp');
      }

      return true;
    });
  }
}
