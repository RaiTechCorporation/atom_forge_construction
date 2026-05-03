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
        Schema::table('site_managers', function (Blueprint $table) {
            $table->string('qualification')->nullable()->after('pincode');
            $table->string('certificate_10th_path')->nullable()->after('photo_path');
            $table->string('certificate_12th_path')->nullable()->after('certificate_10th_path');
            $table->string('graduation_certificate_path')->nullable()->after('certificate_12th_path');
            $table->string('skilled_certificate_path')->nullable()->after('graduation_certificate_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_managers', function (Blueprint $table) {
            $table->dropColumn([
                'qualification',
                'certificate_10th_path',
                'certificate_12th_path',
                'graduation_certificate_path',
                'skilled_certificate_path'
            ]);
        });
    }
};
