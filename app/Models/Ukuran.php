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

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_ukuran', 'id_ukuran');
    }
}