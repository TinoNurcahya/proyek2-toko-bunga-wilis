<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukUkuran extends Model
{
    use HasFactory;

    protected $table = 'produk_ukuran';
    protected $primaryKey = 'id_produk_ukuran';

    protected $fillable = [
        'id_produk',
        'id_ukuran',
        'stok',
        'harga'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function ukuran()
    {
        return $this->belongsTo(Ukuran::class, 'id_ukuran');
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'id_produk_ukuran');
    }
    // public function pesananItems()
    // {
    //     return $this->hasMany(PesananItem::class, 'id_produk_ukuran');
    // }
}
