<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';

    protected $fillable = [
        'id_users',
        'total_harga',
        'status',
        'metode_pembayaran',
        'tanggal_pesanan',
        'alamat_pengiriman',
        'snap_token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function items()
    {
        return $this->hasMany(ItemPesanan::class, 'id_pesanan');
    }
}
