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
            $table->boolean('deadline_alerts')->default(true)->after('inspection_reports');
            $table->boolean('budget_alerts')->default(true)->after('deadline_alerts');
            $table->boolean('task_reminders')->default(true)->after('budget_alerts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['deadline_alerts', 'budget_alerts', 'task_reminders']);
        });
    }
};
