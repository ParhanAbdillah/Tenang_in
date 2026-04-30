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
        Schema::table('psychologists', function (Blueprint $table) {
                $table->string('clinical_type')->nullable()->after('name'); // Contoh: Psikolog Klinis Dewasa
                $table->text('educational_background')->nullable()->after('bio');
                $table->integer('total_sessions')->default(0)->after('experience_years');
                $table->integer('satisfaction_rate')->default(100)->after('total_sessions');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('psychologists', function (Blueprint $table) {
        $table->dropColumn(['clinical_type', 'educational_background', 'total_sessions', 'satisfaction_rate']);
    });
    }
};
