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
        Schema::create('keranjang', function (Blueprint $table) {
            $table->id('id_keranjang');
            $table->foreignId('id_users')
                ->constrained('users', 'id_users')
                ->onDelete('cascade');
            $table->foreignId('id_produk_ukuran')
                ->constrained('produk_ukuran', 'id_produk_ukuran')
                ->onDelete('cascade');
            $table->integer('jumlah')->default(1);
            $table->timestamps();

            $table->unique(['id_users', 'id_produk_ukuran']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};
