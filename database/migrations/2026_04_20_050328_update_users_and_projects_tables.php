<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('client')->change();
        });

        // Map old roles to new roles
        DB::table('users')->where('role', 'admin')->update(['role' => 'super_admin']);
        DB::table('users')->whereIn('role', ['site_manager', 'accountant'])->update(['role' => 'admin_staff']);

        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['super_admin', 'admin_staff', 'client', 'investor'])->default('client')->change();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('client_id')->nullable()->after('id')->constrained('users');
            $table->string('project_type')->after('location')->comment('Basic, Standard, Premium, Luxury, Ultra Luxury, Custom');
            $table->decimal('cost_per_sqft', 10, 2)->after('project_type')->default(0);
            $table->decimal('total_area_sqft', 15, 2)->after('cost_per_sqft')->default(0);
            $table->enum('stage', ['Planning', 'Foundation', 'Structure', 'Finishing', 'Completed'])->default('Planning')->after('status');
            $table->text('description')->nullable()->after('name');
            $table->json('features')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
             $table->enum('role', ['admin', 'site_manager', 'accountant', 'investor'])->default('site_manager')->change();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropColumn(['client_id', 'project_type', 'cost_per_sqft', 'total_area_sqft', 'stage', 'description', 'features']);
        });
    }
};
