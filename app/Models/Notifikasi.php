<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifikasi';

    protected $primaryKey = 'id_notifikasi';

    protected $fillable = [
        'id_users',
        'judul',
        'pesan',
        'status',
    ];

    public function scopeOrderByUnreadFirst($query)
    {
        return $query->orderByRaw("CASE WHEN status = 'belum_dibaca' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'desc');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }
}
