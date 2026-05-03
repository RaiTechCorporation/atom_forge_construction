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
        Schema::create('site_managers', function (Blueprint $table) {
            $table->id();
            $table->string('manager_unique_id')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('father_name')->nullable();
            $table->text('current_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('set null');
            $table->decimal('salary_amount', 12, 2)->default(0);
            $table->string('salary_type')->default('Monthly'); // Monthly, Daily, etc.
            $table->string('aadhaar_number')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('id_proof_path')->nullable();
            $table->string('pan_proof_path')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->date('joining_date')->nullable();
            $table->decimal('leave_balance', 5, 2)->default(0);
            $table->string('status')->default('Active');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_managers');
    }
};
