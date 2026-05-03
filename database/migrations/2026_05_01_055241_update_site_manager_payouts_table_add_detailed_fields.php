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
        Schema::table('site_manager_payouts', function (Blueprint $table) {
            $table->decimal('absence_deduction', 12, 2)->default(0)->after('deductions');
            $table->decimal('late_arrival_deduction', 12, 2)->default(0)->after('absence_deduction');
            $table->decimal('advance_salary_recovery', 12, 2)->default(0)->after('late_arrival_deduction');
            $table->decimal('penalty_deduction', 12, 2)->default(0)->after('advance_salary_recovery');
            $table->decimal('paid_amount', 12, 2)->default(0)->after('net_amount');
            $table->string('status')->default('Pending')->change(); // Ensure default is Pending
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_manager_payouts', function (Blueprint $table) {
            $table->dropColumn([
                'absence_deduction',
                'late_arrival_deduction',
                'advance_salary_recovery',
                'penalty_deduction',
                'paid_amount'
            ]);
        });
    }
};
