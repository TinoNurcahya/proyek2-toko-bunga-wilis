<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminOrder extends Model
{
    use HasFactory;

    protected $table = 'admin_orders';

    protected $fillable = [
        'order_code','user_id','customer_name','customer_phone','customer_address',
        'product_qty','subtotal','payment_method','payment_proof','resi','status'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
