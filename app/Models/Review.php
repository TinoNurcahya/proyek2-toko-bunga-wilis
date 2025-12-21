<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $primaryKey = 'id_review';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $table = 'review';


    protected $fillable = [
        'id_produk',
        'id_users',
        'id_pesanan',
        'rating',
        'komentar',
        'tanggal_review'
    ];

    protected $casts = [
        'tanggal_review' => 'datetime',
        'rating' => 'integer'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }

    public function getTanggalFormattedAttribute()
    {
        return $this->tanggal_review->format('d M Y');
    }

    public function getRatingStarsAttribute()
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $this->rating) {
                $stars .= '<i class="fas fa-star text-warning"></i>';
            } else {
                $stars .= '<i class="far fa-star text-warning"></i>';
            }
        }
        return $stars;
    }
    public function getRouteKeyName()
    {
        return 'id_review';
    }
}
