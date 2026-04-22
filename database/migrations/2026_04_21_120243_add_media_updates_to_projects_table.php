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
        Schema::table('projects', function (Blueprint $table) {
            $table->text('site_media')->nullable()->after('mitigation_plans');
            $table->text('progress_photos')->nullable()->after('site_media');
            $table->text('inspection_reports')->nullable()->after('progress_photos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['site_media', 'progress_photos', 'inspection_reports']);
        });
    }
};
