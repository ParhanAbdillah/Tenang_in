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
        Schema::create('test_options', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel pertanyaan yang sudah Anda buat sebelumnya
            $table->foreignId('test_question_id')->constrained('test_questions')->onDelete('cascade');
            $table->string('option_text'); // Contoh: "Hampir setiap hari"
            $table->integer('points');      // Contoh: 3
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_options');
    }
};
