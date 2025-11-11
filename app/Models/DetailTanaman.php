<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTanaman extends Model
{
    use HasFactory;

    protected $table = 'detail_tanaman';
    protected $primaryKey = 'id_detail';
    public $timestamps = true;

    protected $fillable = [
        'id_produk',
        'nama_ilmiah',
        'ukuran_detail',
        'asal_tanaman'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}