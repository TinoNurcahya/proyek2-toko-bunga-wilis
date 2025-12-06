<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('admin_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->index(); // kaitkan dengan pesanan.kode_pesanan
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->text('customer_address')->nullable();

            // ringkasan produk
            $table->integer('product_qty')->default(0);
            $table->integer('subtotal')->default(0);

            $table->string('payment_method')->nullable();
            $table->string('payment_proof')->nullable();
            $table->string('resi')->nullable();

            $table->enum('status', [
                'MENUNGGU PEMBAYARAN',
                'DIKEMAS',
                'DIKIRIM',
                'SAMPAI TUJUAN',
                'SELESAI',
                'DIBATALKAN'
            ])->default('MENUNGGU PEMBAYARAN');

            $table->timestamps();

            // FIX: foreign key ke id_users
            $table->foreign('user_id')
                  ->references('id_users')
                  ->on('users')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_orders');
    }
};
