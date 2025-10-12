<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->foreignId('id_users')
                ->constrained('users', 'id_users')
                ->onDelete('cascade');
            $table->decimal('total_harga', 10, 2);
            $table->enum('status', ['menunggu', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->string('metode_pembayaran');
            $table->dateTime('tanggal_pesanan')->useCurrent();
            $table->text('alamat_pengiriman')->nullable();
            $table->string('snap_token')->nullable(); // untuk integrasi Midtrans
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
