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
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->foreignId('id_kategori')->constrained('kategori', 'id_kategori')->onDelete('cascade');
            $table->foreignId('id_ukuran')->constrained('ukuran', 'id_ukuran')->onDelete('cascade');
            $table->string('nama');
            $table->decimal('harga', 10, 2);
            $table->integer('stok');
            $table->string('foto_utama')->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('terjual')->default(0);
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('jumlah_rating')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
