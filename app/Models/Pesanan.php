<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';

    protected $fillable = [
        'id_users',
        'nama_penerima',
        'email_penerima',
        'telepon_penerima',
        'alamat_pengiriman',
        'subtotal',
        'pajak',
        'total_harga',
        'status',
        'metode_pembayaran',
        'bank',
        'va_number',
        'tanggal_pesanan',
        'snap_token',
        'kode_pesanan'
    ];

    protected $casts = [
        'total_harga' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'pajak' => 'decimal:2',
        'tanggal_pesanan' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }

    public function items()
    {
        return $this->hasMany(PesananItem::class, 'id_pesanan', 'id_pesanan');
    }

    public function getKotaAttribute()
    {
        return $this->user->kota ?? null;
    }

    public function getKodePosAttribute()
    {
        return $this->user->kode_pos ?? null;
    }
}
