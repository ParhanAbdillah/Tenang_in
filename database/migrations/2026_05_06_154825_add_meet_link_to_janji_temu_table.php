<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('janji_temu', function (Blueprint $table) {
            $table->string('link_video_call')->nullable()->after('status');
        });

        // Update enum status using raw SQL as Laravel change() for enum is limited
        DB::statement("ALTER TABLE janji_temu MODIFY COLUMN status ENUM('menunggu', 'dijadwalkan', 'selesai', 'dibatalkan', 'dikonfirmasi') DEFAULT 'menunggu'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('janji_temu', function (Blueprint $table) {
            $table->dropColumn('link_video_call');
        });
        
        DB::statement("ALTER TABLE janji_temu MODIFY COLUMN status ENUM('menunggu', 'dikonfirmasi', 'selesai', 'dibatalkan') DEFAULT 'menunggu'");
    }
};
