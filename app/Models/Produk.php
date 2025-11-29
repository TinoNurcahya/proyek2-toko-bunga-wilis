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

    // RELATIONSHIP UNTUK PRODUK_UKURAN
    public function produkUkuran()
    {
        return $this->hasMany(ProdukUkuran::class, 'id_produk', 'id_produk');
    }

    // RELATIONSHIP DENGAN UKURAN MELALUI PRODUK_UKURAN
    public function ukurans()
    {
        return $this->belongsToMany(Ukuran::class, 'produk_ukuran', 'id_produk', 'id_ukuran')
            ->withPivot('harga', 'stok')
            ->withTimestamps();
    }

    // ACCESSOR UNTUK HARGA TERENDAH
    public function getHargaTerendahAttribute()
    {
        return $this->produkUkuran()->min('harga');
    }

    // ACCESSOR UNTUK HARGA TERTINGGI
    public function getHargaTertinggiAttribute()
    {
        return $this->produkUkuran()->max('harga');
    }

    public function getTerjualFormattedAttribute()
    {
        return $this->terjual >= 1000
            ? floor($this->terjual / 1000) . 'rb+'
            : $this->terjual;
    }

    public function getRouteKeyName()
    {
        return 'id_produk';
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'id_produk', 'id_produk');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function petunjukPerawatan()
    {
        return $this->hasOne(PetunjukPerawatan::class, 'id_produk', 'id_produk');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_produk', 'id_produk');
    }

    public function fotoProduk()
    {
        return $this->hasMany(FotoProduk::class, 'id_produk', 'id_produk');
    }
}
