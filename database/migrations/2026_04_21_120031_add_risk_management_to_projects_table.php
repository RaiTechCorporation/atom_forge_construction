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
            $table->text('identified_risks')->nullable()->after('blueprints_layouts');
            $table->text('issue_logs')->nullable()->after('identified_risks');
            $table->text('delay_reasons')->nullable()->after('issue_logs');
            $table->text('mitigation_plans')->nullable()->after('delay_reasons');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['identified_risks', 'issue_logs', 'delay_reasons', 'mitigation_plans']);
        });
    }
};
