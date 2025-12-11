<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\PesananItem;
use App\Models\ProdukUkuran;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CheckoutPage extends Component
{
  public $nama;
  public $email;
  public $telepon;
  public $alamat;
  public $kota;
  public $kode_pos;

  public $keranjangItems;
  public $subtotal = 0;
  public $pajak = 0;
  public $total = 0;
  public $ongkir = 0;

  public $selectedItemsFromCart = [];
  public $isProcessing = false;

  protected $rules = [
    'nama' => 'required|min:3',
    'email' => 'required|email',
    'telepon' => 'required|min:10|max:15',
    'alamat' => 'required|min:10',
    'kota' => 'required',
    'kode_pos' => 'required|numeric'
  ];

  public function mount()
  {
    if (!Auth::check()) {
      return redirect()->route('login');
    }

    $this->selectedItemsFromCart = Session::get('checkout_items', []);

    if (empty($this->selectedItemsFromCart)) {
      $this->selectedItemsFromCart = Keranjang::where('id_users', Auth::id())
        ->pluck('id_keranjang')
        ->toArray();
    }

    $this->loadKeranjangItems();

    $user = Auth::user();
    $this->nama = $user->nama;
    $this->email = $user->email;
    $this->telepon = $user->no_hp ?? '';
    $this->alamat = $user->alamat ?? '';
    $this->kota = $user->kota ?? '';
    $this->kode_pos = $user->kode_pos ?? '';
  }

  public function loadKeranjangItems()
  {
    $query = Keranjang::with(['produkUkuran.produk', 'produkUkuran.ukuran'])
      ->where('id_users', Auth::id());

    if (!empty($this->selectedItemsFromCart)) {
      $query->whereIn('id_keranjang', $this->selectedItemsFromCart);
    }

    $this->keranjangItems = $query->get();

    if ($this->keranjangItems->isEmpty()) {
      session()->flash('error', 'Tidak ada item yang dipilih untuk checkout.');
      return redirect()->route('profile.keranjang');
    }

    $this->hitungTotal();
  }

  public function hitungTotal()
  {
    $this->subtotal = $this->keranjangItems->sum(function ($item) {
      return $item->jumlah * ($item->produkUkuran->harga ?? 0);
    });

    $this->pajak = $this->subtotal * 0.11;
    $this->ongkir = 0;
    $this->total = $this->subtotal + $this->pajak + $this->ongkir;
  }

  public function prosesCheckout()
  {
    $this->validate();
    $this->isProcessing = true;

    try {
      // Cek stok untuk semua items
      foreach ($this->keranjangItems as $item) {
        if (!$item->produkUkuran) {
          session()->flash('error', 'Produk tidak ditemukan atau tidak tersedia.');
          $this->isProcessing = false;
          return;
        }

        if ($item->produkUkuran->stok < $item->jumlah) {
          $productName = $item->produkUkuran->produk->nama ?? 'Produk tidak tersedia';
          session()->flash('error', 'Stok untuk produk ' . $productName . ' tidak mencukupi');
          $this->isProcessing = false;
          return;
        }
      }

      DB::beginTransaction();

      // Buat Pesanan
      $pesanan = Pesanan::create([
        'id_users' => Auth::id(),
        'nama_penerima' => $this->nama,
        'email_penerima' => $this->email,
        'telepon_penerima' => $this->telepon,
        'alamat_pengiriman' => $this->alamat . ', ' . $this->kota . ' ' . $this->kode_pos,
        'subtotal' => $this->subtotal,
        'pajak' => $this->pajak,
        'total_harga' => $this->total,
        'status' => 'menunggu',
        'metode_pembayaran' => 'midtrans',
        'snap_token' => null,
        'kode_pesanan' => 'ORD-' . time() . '-' . rand(1000, 9999),
        'tanggal_pesanan' => now(),
      ]);

      // Buat Pesanan Items
      foreach ($this->keranjangItems as $item) {
        PesananItem::create([
          'id_pesanan' => $pesanan->id_pesanan,
          'id_produk_ukuran' => $item->id_produk_ukuran,
          'harga_satuan' => $item->produkUkuran->harga,
          'kuantitas' => $item->jumlah,
          'subtotal' => $item->jumlah * $item->produkUkuran->harga
        ]);

        // Update stok
        $item->produkUkuran->decrement('stok', $item->jumlah);
      }

      // Generate Snap Token dari Midtrans
      $midtransService = new MidtransService();
      $snapToken = $midtransService->createTransaction($pesanan);

      // Update pesanan dengan snap token
      $pesanan->update(['snap_token' => $snapToken]);

      // Hapus items dari keranjang
      if (!empty($this->selectedItemsFromCart)) {
        Keranjang::whereIn('id_keranjang', $this->selectedItemsFromCart)
          ->where('id_users', Auth::id())
          ->delete();
      } else {
        Keranjang::where('id_users', Auth::id())->delete();
      }

      // Clear session
      Session::forget('checkout_items');

      DB::commit();

      // Redirect ke halaman pembayaran Midtrans
      return redirect()->route('pembayaran.midtrans', ['kode' => $pesanan->kode_pesanan])
        ->with('success', 'Pesanan berhasil dibuat! Silakan selesaikan pembayaran.');
    } catch (\Exception $e) {
      DB::rollBack();
      $this->isProcessing = false;
      session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
  }

  public function render()
  {
    return view('livewire.checkout-page');
  }
}
