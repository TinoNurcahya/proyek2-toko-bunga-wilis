<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesananItem extends Model
{
    protected $table = 'pesanan_item';
    protected $primaryKey = 'id_pesanan_item';
    
    protected $fillable = [
        'id_pesanan',
        'id_produk_ukuran',
        'harga_satuan',
        'kuantitas',
        'subtotal'
    ];

    protected $casts = [
        'harga_satuan' => 'decimal:2',
        'subtotal' => 'decimal:2'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }

    public function produkUkuran()
    {
        return $this->belongsTo(ProdukUkuran::class, 'id_produk_ukuran', 'id_produk_ukuran');
    }

    public function getTotalAttribute()
    {
        return $this->harga_satuan * $this->kuantitas;
    }
}