<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMidtransNotificationLogsTable extends Migration
{
    public function up()
    {
        Schema::create('midtrans_notification_logs', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id'); //Midtrans
            $table->string('order_id');
            $table->string('status');
            $table->json('payload')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();

            $table->index('order_id');
            $table->index(['order_id', 'status']);
        });

        // Tambahkan kolom tracking di tabel pesanan
        Schema::table('pesanan', function (Blueprint $table) {
            $table->timestamp('stock_updated_at')->nullable()->after('status');
            $table->string('last_notification_id')->nullable()->after('stock_updated_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('midtrans_notification_logs');
        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropColumn(['stock_updated_at', 'last_notification_id']);
        });
    }
};
