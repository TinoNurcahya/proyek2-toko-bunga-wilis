<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Review;

class ProductReviews extends Component
{
    use WithPagination;

    public $produkId;

    // menggunakan bootstrap theme
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['reviewAdded' => '$refresh'];

    public function mount($produkId)
    {
        $this->produkId = $produkId;
    }

    public function render()
    {
        $reviews = Review::with(['user'])
            ->where('id_produk', $this->produkId)
            ->orderBy('tanggal_review', 'desc')
            ->paginate(2); // jumlah per page (ganti nanti sesuai kebutuhan)

        return view('livewire.product-reviews', compact('reviews'));
    }
}