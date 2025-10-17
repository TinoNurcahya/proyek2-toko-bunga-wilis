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
        Schema::create('petunjuk_perawatan', function (Blueprint $table) {
            $table->id('id_petunjuk_perawatan');
            $table->foreignId('id_produk')
                ->constrained('produk', 'id_produk')
                ->onDelete('cascade');
            $table->text('penyiraman')->nullable();
            $table->text('cahaya')->nullable();
            $table->text('suhu_dan_kelembapan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petunjuk_perawatan');
    }
};
