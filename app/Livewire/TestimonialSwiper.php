<?php

namespace App\Livewire;

use App\Models\Review;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class TestimonialSwiper extends Component
{
    public $testimonials;

    public function mount()
    {
        $this->loadTestimonials();
    }

    public function refreshTestimonials()
    {
        $this->loadTestimonials();
    }

    private function loadTestimonials()
    {
        // Cache lebih lama untuk kurangi polling impact
        $this->testimonials = Cache::remember('testimonials-high-rating', 120, function () {
            return Review::with(['produk', 'user'])
                ->where('rating', '>=', 4)
                ->orderBy('tanggal_review', 'desc')
                ->limit(5)
                ->get();
        });
    }

    public function render()
    {
        return view('livewire.testimonial-swiper');
    }
}