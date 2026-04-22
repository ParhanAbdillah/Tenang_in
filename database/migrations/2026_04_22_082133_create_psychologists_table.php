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
        Schema::create('psychologists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('specialization'); // Relasi ke code di table specializations
            $table->string('license_number')->unique(); // No. STR
            $table->integer('experience_years')->default(0);
            $table->decimal('price_per_session', 15, 2);
            $table->text('bio')->nullable(); // Deskripsi profil
            $table->string('photo')->nullable(); // Nama file foto
            $table->enum('status', ['pending', 'active', 'inactive'])->default('pending');
            $table->timestamps();

            $table->foreign('specialization')->references('code')->on('specializations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('psychologists');
    }
};
