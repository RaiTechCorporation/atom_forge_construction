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
            $table->string('tenth_passing_year')->nullable()->after('qualification');
            $table->string('tenth_percentage')->nullable()->after('tenth_passing_year');
            $table->string('tenth_board')->nullable()->after('tenth_percentage');
            $table->string('twelfth_passing_year')->nullable()->after('tenth_board');
            $table->string('twelfth_percentage')->nullable()->after('twelfth_passing_year');
            $table->string('twelfth_board')->nullable()->after('twelfth_percentage');
            $table->string('graduation_passing_year')->nullable()->after('twelfth_board');
            $table->string('graduation_percentage')->nullable()->after('graduation_passing_year');
            $table->string('graduation_university')->nullable()->after('graduation_percentage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_managers', function (Blueprint $table) {
            $table->dropColumn([
                'tenth_passing_year',
                'tenth_percentage',
                'tenth_board',
                'twelfth_passing_year',
                'twelfth_percentage',
                'twelfth_board',
                'graduation_passing_year',
                'graduation_percentage',
                'graduation_university',
            ]);
        });
    }
};
