<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
        'kode_pesanan',
        'stock_updated_at',
        'last_notification_id',
    ];

    protected $casts = [
        'total_harga' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'pajak' => 'decimal:2',
        'tanggal_pesanan' => 'datetime',
        'stock_updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }

    public function items()
    {
        return $this->hasMany(PesananItem::class, 'id_pesanan', 'id_pesanan');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_pesanan', 'id_pesanan')
            ->with(['produk', 'user']);
    }

    public function getKotaAttribute()
    {
        return $this->user->kota ?? null;
    }

    public function getKodePosAttribute()
    {
        return $this->user->kode_pos ?? null;
    }

    public function sudahDireview()
    {
        if (!Auth::check()) {
            return false;
        }

        return $this->reviews()
            ->where('id_users', Auth::user()->id_users)
            ->exists();
    }

    public function produkBelumDireview()
    {
        if (!Auth::check()) {
            return collect();
        }

        $reviewedProductIds = $this->reviews()
            ->where('id_users', Auth::user()->id_users)
            ->pluck('id_produk')
            ->toArray();

        $unreviewedItems = collect();

        foreach ($this->items as $item) {
            if ($item->produkUkuran && $item->produkUkuran->produk) {
                $produkId = $item->produkUkuran->produk->id_produk;
                if (!in_array($produkId, $reviewedProductIds)) {
                    $unreviewedItems->push([
                        'item' => $item,
                        'produk' => $item->produkUkuran->produk,
                        'produk_id' => $produkId,
                        'ukuran' => $item->produkUkuran->ukuran ?? null
                    ]);
                }
            }
        }

        return $unreviewedItems;
    }

    public function jumlahProdukBelumDireview()
    {
        return $this->produkBelumDireview()->count();
    }

    public function getReviewForProduct($produkId)
    {
        return $this->reviews()
            ->where('id_produk', $produkId)
            ->where('id_users', Auth::user()->id_users)
            ->first();
    }
}
