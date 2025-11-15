<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ukuran extends Model
{
    use HasFactory;

    protected $table = 'ukuran';
    protected $primaryKey = 'id_ukuran';
    public $timestamps = true;

    protected $fillable = [
        'nama_ukuran',
    ];

    // RELATIONSHIP PRODUK_UKURAN
    public function produkUkuran()
    {
        return $this->hasMany(ProdukUkuran::class, 'id_ukuran', 'id_ukuran');
    }

    // RELATIONSHIP MANY-TO-MANY DENGAN PRODUK
    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'produk_ukuran', 'id_ukuran', 'id_produk')
            ->withPivot('harga', 'stok')
            ->withTimestamps();
    }
}
