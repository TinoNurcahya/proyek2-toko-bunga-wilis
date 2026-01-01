<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetunjukPerawatan extends Model
{
    use HasFactory;

    protected $table = 'petunjuk_perawatan';
    
    protected $primaryKey = 'id_petunjuk_perawatan';
    
    public $incrementing = true;
    protected $keyType = 'int';
    
    protected $fillable = [
        'id_produk',
        'penyiraman',
        'cahaya',
        'suhu_dan_kelembapan'
    ];

    // Relasi ke Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}