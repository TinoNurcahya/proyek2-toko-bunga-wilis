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
            // Data penerima
            $table->id('id_pesanan');
            $table->foreignId('id_users')
                ->constrained('users', 'id_users')
                ->onDelete('cascade');
            $table->string('nama_penerima')->nullable();
            $table->string('email_penerima')->nullable();
            $table->string('telepon_penerima')->nullable();

            // Data harga
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('pajak', 10, 2)->default(0);
            $table->decimal('total_harga', 10, 2);

            // Status & metadata
            $table->enum('status', ['menunggu', 'diproses', 'dikirim', 'selesai', 'dibatalkan', 'dibayar'])->default('menunggu');
            $table->string('metode_pembayaran');
            $table->string('bank')->nullable();
            $table->string('va_number')->nullable();
            $table->dateTime('tanggal_pesanan')->useCurrent();
            $table->text('alamat_pengiriman')->nullable();
            $table->string('snap_token')->nullable(); // untuk integrasi Midtrans
            $table->timestamps();
            $table->string('kode_pesanan')->unique()->nullable();
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
