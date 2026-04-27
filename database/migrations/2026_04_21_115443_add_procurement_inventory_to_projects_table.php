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
            $table->text('material_requirements')->nullable()->after('issue_tracking');
            $table->text('suppliers_info')->nullable()->after('material_requirements');
            $table->text('purchase_orders_summary')->nullable()->after('suppliers_info');
            $table->text('inventory_tracking')->nullable()->after('purchase_orders_summary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'material_requirements',
                'suppliers_info',
                'purchase_orders_summary',
                'inventory_tracking',
            ]);
        });
    }
};
