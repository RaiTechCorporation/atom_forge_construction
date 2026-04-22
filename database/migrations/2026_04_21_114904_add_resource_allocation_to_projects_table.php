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
            $table->text('assigned_team')->nullable()->after('design_documents');
            $table->text('labor_requirements')->nullable()->after('assigned_team');
            $table->text('equipment_machinery')->nullable()->after('labor_requirements');
            $table->text('subcontractors')->nullable()->after('equipment_machinery');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['assigned_team', 'labor_requirements', 'equipment_machinery', 'subcontractors']);
        });
    }
};
