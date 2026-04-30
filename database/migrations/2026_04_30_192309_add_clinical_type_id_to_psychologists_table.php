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
            $table->foreignId('clinical_type_id')->nullable()->constrained('clinical_types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('psychologists', function (Blueprint $table) {
            $table->dropForeign(['clinical_type_id']);
            $table->dropColumn('clinical_type_id');
        });
    }
};
