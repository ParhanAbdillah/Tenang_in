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
        Schema::create('janji_temu', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_pasien')->constrained('users')->onDelete('cascade');
        $table->foreignId('id_psikolog')->constrained('psychologists')->onDelete('cascade');
        $table->date('tanggal_janji');
        $table->time('jam_janji');
        $table->enum('status', ['menunggu', 'dikonfirmasi', 'selesai', 'dibatalkan'])->default('menunggu');
        $table->text('catatan_keluhan')->nullable(); // Keluhan awal dari pasien
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
