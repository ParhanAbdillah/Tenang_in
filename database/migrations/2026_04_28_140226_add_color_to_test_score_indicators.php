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
    Schema::table('test_score_indicators', function (Blueprint $table) {
        $table->string('color')->default('#0A4D68')->after('status');
        $table->text('description')->nullable()->after('color');
        $table->text('recommendation')->nullable()->after('description');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('test_score_indicators', function (Blueprint $table) {
            //
        });
    }
};
