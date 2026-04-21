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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->enum('category', ['material', 'labour', 'equipment', 'transport', 'vendor_bill', 'misc']);
            $table->string('description');
            $table->decimal('amount', 15, 2);
            $table->foreignId('vendor_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('payment_mode', ['cash', 'upi', 'bank']);
            $table->string('bill_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
