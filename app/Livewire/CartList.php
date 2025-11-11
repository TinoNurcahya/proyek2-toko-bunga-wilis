<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Keranjang;
use App\Models\ProdukUkuran;
use Illuminate\Support\Facades\Auth;

class CartList extends Component
{
    public $cartItems;
    public $totalPrice = 0;

    protected $listeners = ['cartUpdated' => 'loadCart'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cartItems = Keranjang::with(['produkUkuran.produk.detailTanaman', 'produkUkuran.ukuran'])
            ->where('id_users', Auth::id())
            ->get();

        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->totalPrice = 0;
        foreach ($this->cartItems as $item) {
            if ($item->produkUkuran) {
                $this->totalPrice += $item->produkUkuran->harga * $item->jumlah;
            }
        }
    }

    public function updateQuantity($cartId, $change)
    {
        $cartItem = Keranjang::where('id_keranjang', $cartId)
            ->where('id_users', Auth::id())
            ->first();

        if ($cartItem && $cartItem->produkUkuran) {
            $newQuantity = $cartItem->jumlah + $change;

            // Validasi minimal 1
            if ($newQuantity < 1) {
                $this->dispatch('show-toast', type: 'error', message: 'Quantity minimal 1');
                return;
            }

            // Validasi stok
            if ($newQuantity > $cartItem->produkUkuran->stok) {
                $this->dispatch('show-toast', type: 'error', message: 'Quantity melebihi stok. Stok tersedia: ' . $cartItem->produkUkuran->stok);
                return;
            }

            $cartItem->update(['jumlah' => $newQuantity]);
            $this->loadCart();
            $this->dispatch('cartUpdated');

            $this->dispatch('show-toast', type: 'success', message: 'Quantity berhasil diupdate');
        }
    }

    public function deleteItem($cartId)
    {
        $cartItem = Keranjang::where('id_keranjang', $cartId)
            ->where('id_users', Auth::id())
            ->first();

        if ($cartItem) {
            $cartItem->delete();
            $this->loadCart();
            $this->dispatch('cartUpdated');

            $this->dispatch('show-toast', type: 'success', message: 'Item berhasil dihapus dari keranjang');
        }
    }

    public function render()
    {
        return view('livewire.cart-list');
    }
}
