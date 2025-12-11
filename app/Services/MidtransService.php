<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use App\Models\Pesanan;
use Illuminate\Http\Request;

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
    $notification = new Notification();

    $orderId = $notification->order_id;
    $transactionStatus = $notification->transaction_status;
    $fraudStatus = $notification->fraud_status ?? null;
    $paymentType = $notification->payment_type ?? null;

    $pesanan = Pesanan::where('kode_pesanan', $orderId)->first();

    if (!$pesanan) {
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

    // Handle status berdasarkan payment type
    if ($transactionStatus == 'capture' && $paymentType == 'credit_card') {
      if ($fraudStatus == 'challenge') {
        $newStatus = 'menunggu';
      } else {
        $newStatus = 'dibayar';
      }
    } else {
      $newStatus = $statusMap[$transactionStatus] ?? 'menunggu';
    }

    // AMBIL JENIS PAYMENT TYPE
    $paymentType = $notification->payment_type ?? null;
    $bankName = null;

    // Jika metode pembayaran adalah bank transfer (VA)
    if ($paymentType == 'bank_transfer' && !empty($notification->va_numbers)) {
      $bankName = $notification->va_numbers[0]->bank ?? null;
    }

    // Jika QRIS
    if ($paymentType == 'qris') {
      $bankName = 'QRIS';
    }

    // Jika GoPay
    if ($paymentType == 'gopay') {
      $bankName = 'GoPay';
    }

    // Jika ShopeePay
    if ($paymentType == 'shopeepay') {
      $bankName = 'ShopeePay';
    }

    // Update status & metode pembayaran
    $pesanan->update([
      'status' => $newStatus,
      'metode_pembayaran' => $bankName ?? $paymentType ?? $pesanan->metode_pembayaran,
    ]);


    // Jika sudah dibayar
    if ($newStatus == 'dibayar') {
      $this->updateStockAfterPayment($pesanan);
    }

    return [
      'status' => 'success',
      'transaction_status' => $transactionStatus,
      'order_id' => $orderId,
      'pesanan_status' => $newStatus
    ];
  }

  private function updateStockAfterPayment(Pesanan $pesanan)
  {
    foreach ($pesanan->items as $item) {
      $produkUkuran = $item->produkUkuran;
      if ($produkUkuran) {
        // Kurangi stok
        $produkUkuran->decrement('stok', $item->kuantitas);

        // Tambahkan terjual di produk utama
        $produk = $produkUkuran->produk;
        if ($produk) {
          $produk->increment('terjual', $item->kuantitas);
        }
      }
    }
  }
}
