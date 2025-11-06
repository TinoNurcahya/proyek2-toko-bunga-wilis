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
        Schema::create('produk_ukuran', function (Blueprint $table) {
            $table->id('id_produk_ukuran');
            $table->foreignId('id_produk')
                ->constrained('produk', 'id_produk')
                ->onDelete('cascade');
            $table->foreignId('id_ukuran')
                ->constrained('ukuran', 'id_ukuran')
                ->onDelete('cascade');
            $table->integer('stok');
            $table->decimal('harga', 10, 2);
            $table->timestamps();

            $table->unique(['id_produk', 'id_ukuran']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_ukuran');
    }
};
