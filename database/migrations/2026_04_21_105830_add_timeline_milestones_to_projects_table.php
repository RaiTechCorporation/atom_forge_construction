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
            $table->string('estimated_duration')->nullable()->after('end_date');
            $table->date('milestone_planning_approval')->nullable()->after('estimated_duration');
            $table->date('milestone_foundation_start')->nullable()->after('milestone_planning_approval');
            $table->date('milestone_structure_completion')->nullable()->after('milestone_foundation_start');
            $table->date('milestone_finishing_phase')->nullable()->after('milestone_structure_completion');
            $table->date('milestone_handover')->nullable()->after('milestone_finishing_phase');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'estimated_duration',
                'milestone_planning_approval',
                'milestone_foundation_start',
                'milestone_structure_completion',
                'milestone_finishing_phase',
                'milestone_handover'
            ]);
        });
    }
};
