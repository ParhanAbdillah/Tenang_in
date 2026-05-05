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
        Schema::table('janji_temu', function (Blueprint $table) {
            // order_id unik untuk identifikasi transaksi di Midtrans
            $table->string('order_id')->nullable()->after('id');
            $table->integer('gross_amount')->nullable()->after('order_id');
            // snap_token untuk memunculkan pop-up pembayaran tanpa reload
            $table->string('snap_token')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('janji_temu', function (Blueprint $table) {
            $table->dropColumn(['order_id', 'gross_amount', 'snap_token']);
        });
    }
};
