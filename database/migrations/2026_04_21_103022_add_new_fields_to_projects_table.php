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
        Schema::table('projects', function (Blueprint $table) {
            if (! Schema::hasColumn('projects', 'project_code')) {
                $table->string('project_code')->unique()->nullable()->after('id');
            }
            if (! Schema::hasColumn('projects', 'building_type')) {
                $table->enum('building_type', ['Residential', 'Commercial', 'Industrial', 'Infrastructure'])->nullable()->after('project_type');
            }
            if (! Schema::hasColumn('projects', 'priority')) {
                $table->enum('priority', ['Low', 'Medium', 'High', 'Urgent'])->default('Medium')->after('status');
            }

            $table->string('status')->default('Planned')->change();
        });

        // Update existing status values to new ones
        // We use try-catch or check if 'active' exists to be safe
        try {
            DB::table('projects')->where('status', 'active')->update(['status' => 'Ongoing']);
            DB::table('projects')->where('status', 'on_hold')->update(['status' => 'On Hold']);
            DB::table('projects')->where('status', 'completed')->update(['status' => 'Completed']);
        } catch (Exception $e) {
            // Already updated or failed for other reasons
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['project_code', 'building_type', 'priority']);
            // Reverting status to enum might be hard if it contains new values, so we just set it back to enum
            $table->enum('status', ['active', 'completed', 'on_hold'])->default('active')->change();
        });
    }
};
