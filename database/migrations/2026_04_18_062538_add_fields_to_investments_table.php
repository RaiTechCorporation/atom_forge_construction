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
        Schema::table('investments', function (Blueprint $table) {
            $table->renameColumn('amount', 'investment_amount');
            $table->decimal('expected_return', 5, 2)->after('investment_date')->nullable()->comment('percentage');
            $table->decimal('profit_share', 5, 2)->after('expected_return')->nullable()->comment('percentage');
            $table->enum('payout_cycle', ['monthly', 'quarterly', 'end'])->after('profit_share')->default('end');
            $table->string('agreement_file')->after('payout_cycle')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('agreement_file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('investments', function (Blueprint $table) {
            $table->dropColumn(['expected_return', 'profit_share', 'payout_cycle', 'agreement_file', 'status']);
            $table->renameColumn('investment_amount', 'amount');
        });
    }
};
