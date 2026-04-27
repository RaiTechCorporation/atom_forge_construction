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
            $table->string('client_phone')->nullable()->after('client_name');
            $table->string('client_email')->nullable()->after('client_phone');
            $table->string('contractor_name')->nullable()->after('client_email');
            $table->string('project_manager')->nullable()->after('contractor_name');
            $table->string('architect')->nullable()->after('project_manager');
            $table->string('consultant')->nullable()->after('architect');
            $table->text('vendor_list')->nullable()->after('consultant');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'client_phone',
                'client_email',
                'contractor_name',
                'project_manager',
                'architect',
                'consultant',
                'vendor_list',
            ]);
        });
    }
};
