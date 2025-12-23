<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\ProdukUkuran;
use Illuminate\Support\Facades\Auth;

class ProductDetail extends Component
{
    public $produk;
    public $quantity = 1;
    public $selectedSizeId;
    public $selectedPrice;
    public $selectedStock;

    //Loading state properties
    public $addingToCart = false;
    public $changingSize = false;

    public function mount($produk)
    {
        $this->produk = $produk;

        // Set default selected size
        if ($this->produk->produkUkuran && $this->produk->produkUkuran->count() > 0) {
            $firstSize = $this->produk->produkUkuran->first();
            $this->selectedSizeId = $firstSize->id_produk_ukuran;
            $this->selectedPrice = $firstSize->harga;
            $this->selectedStock = $firstSize->stok;
        } else {
            $this->selectedPrice = $this->produk->harga_terendah ?? 0;
            $this->selectedStock = $this->produk->stok_total ?? 0;
        }
    }

    public function addToCart()
    {
        // SET LOADING STATE
        $this->addingToCart = true;

        // Cek login
        if (!Auth::check()) {
            $this->dispatch('show-login-modal');
            $this->addingToCart = false; // RESET LOADING STATE
            return;
        }

        // Validasi
        if (!$this->selectedSizeId) {
            $this->dispatch('show-alert', [
                'type' => 'error',
                'message' => 'Silakan pilih ukuran terlebih dahulu.'
            ]);
            $this->addingToCart = false; // RESET LOADING STATE
            return;
        }

        try {
            $produkUkuran = ProdukUkuran::find($this->selectedSizeId);

            if (!$produkUkuran) {
                $this->dispatch('show-alert', [
                    'type' => 'error',
                    'message' => 'Produk tidak ditemukan.'
                ]);
                $this->addingToCart = false; // RESET LOADING STATE
                return;
            }

            if ($produkUkuran->stok < $this->quantity) {
                $this->dispatch('show-alert', [
                    'type' => 'error',
                    'message' => 'Stok tidak mencukupi. Stok tersedia: ' . $produkUkuran->stok
                ]);
                $this->addingToCart = false; // RESET LOADING STATE
                return;
            }

            // Cek apakah item sudah ada di keranjang
            $existingCart = Keranjang::where('id_users', Auth::id())
                ->where('id_produk_ukuran', $this->selectedSizeId)
                ->first();

            if ($existingCart) {
                $newQuantity = $existingCart->jumlah + $this->quantity;

                if ($newQuantity > $produkUkuran->stok) {
                    $this->dispatch('show-alert', [
                        'type' => 'error',
                        'message' => 'Jumlah melebihi stok. Stok tersedia: ' . $produkUkuran->stok
                    ]);
                    $this->addingToCart = false; // RESET LOADING STATE
                    return;
                }

                $existingCart->update(['jumlah' => $newQuantity]);
                $message = 'Quantity produk di keranjang berhasil diperbarui';
            } else {
                Keranjang::create([
                    'id_users' => Auth::id(),
                    'id_produk_ukuran' => $this->selectedSizeId,
                    'jumlah' => $this->quantity
                ]);
                $message = 'Produk berhasil ditambahkan ke keranjang';
            }

            $this->dispatch('cart-updated');
            $this->dispatch('show-alert', [
                'type' => 'success',
                'message' => $message
            ]);
        } catch (\Exception $e) {
            $this->dispatch('show-alert', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        } finally {
            $this->addingToCart = false;
        }
    }

    public function selectSize($sizeId, $price, $stock)
    {
        $this->changingSize = true; // Loading state untuk ukuran

        $this->selectedSizeId = $sizeId;
        $this->selectedPrice = $price;
        $this->selectedStock = $stock;
        $this->quantity = 1;

        $this->changingSize = false; // Reset loading state
    }

    public function updateQuantity($change)
    {
        $newQuantity = $this->quantity + $change;

        if ($newQuantity >= 1 && $newQuantity <= $this->selectedStock) {
            $this->quantity = $newQuantity;
        }
    }

    public function buyNow()
    {
        if (!$this->selectedSizeId) {
            $this->dispatch('show-alert', [
                'type' => 'error',
                'message' => 'Silakan pilih ukuran terlebih dahulu'
            ]);
            return;
        }

        if ($this->quantity > $this->selectedStock) {
            $this->dispatch('show-alert', [
                'type' => 'error',
                'message' => 'Stok tidak mencukupi'
            ]);
            return;
        }

        Keranjang::updateOrCreate(
            [
                'id_users' => Auth::id(),
                'id_produk_ukuran' => $this->selectedSizeId,
            ],
            [
                'jumlah' => $this->quantity,
            ]
        );
        return redirect()->route('checkout');
    }

    public function render()
    {
        return view('livewire.product-detail');
    }
}
