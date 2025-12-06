<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $fillable = [
        'user_id','kode_pesanan','nama_penerima','telepon','alamat',
        'total_harga','status','metode_pembayaran','bukti_pembayaran'
    ];

    public function items()
    {
        return $this->hasMany(ItemPesanan::class, 'pesanan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
