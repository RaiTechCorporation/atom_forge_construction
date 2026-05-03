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
        Schema::create('site_manager_payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_manager_id')->constrained('site_managers')->onDelete('cascade');
            $table->date('payout_date');
            $table->string('month'); // e.g., "April 2026"
            $table->decimal('base_salary', 12, 2);
            $table->decimal('bonus', 12, 2)->default(0);
            $table->decimal('deductions', 12, 2)->default(0);
            $table->decimal('net_amount', 12, 2);
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('status')->default('Pending'); // Pending, Paid
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_manager_payouts');
    }
};
