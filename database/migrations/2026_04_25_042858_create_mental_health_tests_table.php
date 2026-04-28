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
        Schema::create('test_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique(); // <-- Pastikan baris ini ada
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('test_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_category_id')->constrained('test_categories')->onDelete('cascade');
            $table->text('question_text');
            $table->integer('points')->default(1);
            $table->integer('order')->default(0); // <-- TAMBAHKAN BARIS INI
            $table->timestamps();
        });

        Schema::create('test_score_indicators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_category_id')->constrained('test_categories')->onDelete('cascade');
            $table->integer('min_score');
            $table->integer('max_score');
            $table->string('status'); 
            $table->foreignId('recommended_specialization_id')->nullable()->constrained('specializations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mental_health_tests');
    }
};
