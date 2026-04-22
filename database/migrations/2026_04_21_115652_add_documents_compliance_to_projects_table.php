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
            $table->json('contracts_agreements')->nullable()->after('inventory_tracking');
            $table->json('permits_licenses')->nullable()->after('contracts_agreements');
            $table->json('safety_documents')->nullable()->after('permits_licenses');
            $table->json('blueprints_layouts')->nullable()->after('safety_documents');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'contracts_agreements',
                'permits_licenses',
                'safety_documents',
                'blueprints_layouts'
            ]);
        });
    }
};
