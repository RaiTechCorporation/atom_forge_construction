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
            $table->text('wbs_tasks')->nullable()->after('subcontractors');
            $table->text('task_assignments')->nullable()->after('wbs_tasks');
            $table->integer('progress_percent')->default(0)->after('task_assignments');
            $table->text('reports_summary')->nullable()->after('progress_percent');
            $table->text('issue_tracking')->nullable()->after('reports_summary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'wbs_tasks',
                'task_assignments',
                'progress_percent',
                'reports_summary',
                'issue_tracking',
            ]);
        });
    }
};
