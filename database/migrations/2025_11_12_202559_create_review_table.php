<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('review', function (Blueprint $table) {
            $table->id('id_review');

            $table->foreignId('id_produk')
                ->constrained('produk', 'id_produk')
                ->onDelete('cascade');

            $table->foreignId('id_users')
                ->constrained('users', 'id_users')
                ->onDelete('cascade');

            $table->foreignId('id_pesanan')
                ->nullable()
                ->constrained('pesanan', 'id_pesanan')
                ->onDelete('cascade');

            $table->tinyInteger('rating'); // 1-5
            $table->text('komentar')->nullable();
            $table->timestamp('tanggal_review');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('review');
    }
};
