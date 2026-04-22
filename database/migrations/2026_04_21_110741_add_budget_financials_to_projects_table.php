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
            $table->decimal('est_cost_materials', 15, 2)->nullable()->after('total_budget');
            $table->decimal('est_cost_labor', 15, 2)->nullable()->after('est_cost_materials');
            $table->decimal('est_cost_equipment', 15, 2)->nullable()->after('est_cost_labor');
            $table->decimal('est_cost_miscellaneous', 15, 2)->nullable()->after('est_cost_equipment');
            $table->text('payment_terms')->nullable()->after('est_cost_miscellaneous');
            $table->decimal('advance_payment', 15, 2)->nullable()->after('payment_terms');
            $table->enum('billing_cycle', ['Milestone-based', 'Monthly'])->default('Milestone-based')->after('advance_payment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'est_cost_materials',
                'est_cost_labor',
                'est_cost_equipment',
                'est_cost_miscellaneous',
                'payment_terms',
                'advance_payment',
                'billing_cycle'
            ]);
        });
    }
};
