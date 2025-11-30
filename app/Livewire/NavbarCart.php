<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;

class NavbarCart extends Component
{
    public $cartCount = 0;
    public $cartItems = [];
    public $totalPrice = 0;

    // protected $listeners = ['cartUpdated' => 'loadCart'];
        protected $listeners = [
        'cartUpdated' => 'loadCart',
        'cart-updated' => 'loadCart',
        'itemAddedToCart' => 'loadCart',
        'refreshCart' => 'loadCart'
    ];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        if (Auth::check()) {
            $this->cartCount = Keranjang::where('id_users', Auth::id())->count();

            $this->cartItems = Keranjang::with(['produkUkuran.produk.detailTanaman', 'produkUkuran.ukuran'])
                ->where('id_users', Auth::id())
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();

            // Hitung total semua item
            $this->totalPrice = Keranjang::where('id_users', Auth::id())
                ->with('produkUkuran')
                ->get()
                ->sum(function ($item) {
                    return $item->produkUkuran ? $item->produkUkuran->harga * $item->jumlah : 0;
                });
        }
    }

    public function render()
    {
        return view('livewire.navbar-cart');
    }
}
