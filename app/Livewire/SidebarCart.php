<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;

class SidebarCart extends Component
{
    public $cartCount = 0;

    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function mount()
    {
        $this->updateCartCount();
    }

    public function updateCartCount()
    {
        if (Auth::check()) {
            $this->cartCount = Keranjang::where('id_users', Auth::id())->count();
        } else {
            $this->cartCount = 0;
        }
    }

    public function render()
    {
        return view('livewire.sidebar-cart');
    }
}
