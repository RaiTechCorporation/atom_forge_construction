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
        Schema::create('material_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('material_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['purchase', 'transfer_in', 'transfer_out', 'consumption']);
            $table->decimal('quantity', 15, 2);
            $table->decimal('rate', 15, 2)->nullable();
            $table->date('date');
            $table->foreignId('vendor_id')->nullable()->constrained()->onDelete('set null');
            $table->string('bill_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_transactions');
    }
};
