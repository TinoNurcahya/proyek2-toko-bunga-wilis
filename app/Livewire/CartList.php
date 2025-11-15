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
    public $selectedItems = [];
    public $selectAll = false;

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

    public function getTotalItemsCountProperty()
    {
        return $this->cartItems->count();
    }

    public function getSelectedItemsCountProperty()
    {
        return collect($this->selectedItems)
            ->filter(function ($cartId) {
                $item = $this->cartItems->firstWhere('id_keranjang', $cartId);
                return $item && $item->produkUkuran && $item->produkUkuran->stok > 0;
            })
            ->count();
    }

    public function getSelectedTotalPriceProperty()
    {
        $total = 0;
        foreach ($this->cartItems as $item) {
            if (in_array($item->id_keranjang, $this->selectedItems) && 
                $item->produkUkuran && 
                $item->produkUkuran->stok > 0) {
                $total += $item->produkUkuran->harga * $item->jumlah;
            }
        }
        return $total;
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedItems = $this->cartItems
                ->filter(function ($item) {
                    return $item->produkUkuran && $item->produkUkuran->stok > 0;
                })
                ->pluck('id_keranjang')
                ->toArray();
        } else {
            $this->selectedItems = [];
        }
    }

    public function updatedSelectedItems()
    {
        $availableItems = $this->cartItems
            ->filter(function ($item) {
                return $item->produkUkuran && $item->produkUkuran->stok > 0;
            })
            ->pluck('id_keranjang')
            ->toArray();

        $this->selectAll = count($this->selectedItems) === count($availableItems) && count($availableItems) > 0;
    }

    public function updateQuantity($cartId, $change)
    {
        $cartItem = Keranjang::where('id_keranjang', $cartId)
            ->where('id_users', Auth::id())
            ->first();

        if ($cartItem && $cartItem->produkUkuran) {
            // Cek jika stok = 0
            if ($cartItem->produkUkuran->stok == 0) {
                $this->dispatch('show-toast', type: 'error', message: 'Produk sedang habis');
                return;
            }

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

            // Remove from selected items
            $this->selectedItems = array_diff($this->selectedItems, [$cartId]);

            $this->dispatch('show-toast', type: 'success', message: 'Item berhasil dihapus dari keranjang');
        }
    }

    public function deleteSelected()
    {
        $selectedItems = Keranjang::whereIn('id_keranjang', $this->selectedItems)
            ->where('id_users', Auth::id())
            ->get();

        foreach ($selectedItems as $item) {
            $item->delete();
        }

        $this->selectedItems = [];
        $this->selectAll = false;
        $this->loadCart();
        $this->dispatch('cartUpdated');

        $this->dispatch('show-toast', type: 'success', message: 'Item terpilih berhasil dihapus');
    }

    public function render()
    {
        return view('livewire.cart-list', [
            'totalItemsCount' => $this->totalItemsCount // Pass ke view
        ]);
    }
}