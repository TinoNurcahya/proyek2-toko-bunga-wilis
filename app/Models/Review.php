<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $primaryKey = 'id_review';

    protected $fillable = [
        'id_produk',
        'id_users',
        'rating',
        'komentar',
        'tanggal_review',
    ];

    protected static function boot()
    {
        parent::boot();
        static::saved(function ($review) {
            $review->updateProductRating();
        });

        static::deleted(function ($review) {
            $review->updateProductRating();
        });
    }

    public function updateProductRating()
    {
        $produk = $this->produk;
        if (!$produk) return;

        $reviews = $produk->reviews;

        if ($reviews->count() > 0) {
            $produk->rating = $reviews->avg('rating');
            $produk->jumlah_rating = $reviews->count();
        } else {
            $produk->rating = 0;
            $produk->jumlah_rating = 0;
        }

        $produk->save();
    }

    public function getRouteKeyName()
    {
        return 'id_review';
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }
}
