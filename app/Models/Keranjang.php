<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang';
    protected $primaryKey = 'id_keranjang';

    protected $fillable = [
        'id_users',
        'id_produk_ukuran',
        'jumlah'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function produkUkuran()
    {
        return $this->belongsTo(ProdukUkuran::class, 'id_produk_ukuran');
    }
}
