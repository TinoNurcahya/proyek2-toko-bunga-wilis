<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    public $timestamps = true;

    protected $fillable = [
        'id_kategori',
        'nama',
        'foto_utama',
        'deskripsi',
        'terjual',
        'rating',
        'jumlah_rating'
    ];

    public function detailTanaman()
    {
        return $this->hasOne(DetailTanaman::class, 'id_produk', 'id_produk');
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'id_produk', 'id_produk');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function ukuran()
    {
        return $this->belongsTo(Ukuran::class, 'id_ukuran', 'id_ukuran');
    }
}