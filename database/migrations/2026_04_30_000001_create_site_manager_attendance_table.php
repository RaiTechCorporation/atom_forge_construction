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
        Schema::create('site_manager_attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_manager_id')->constrained('site_managers')->onDelete('cascade');
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('set null');
            $table->date('date');
            $table->string('status'); // Present, Absent, Leave, Half Day
            $table->string('leave_type')->nullable(); // Sick, Casual, Earned, etc.
            $table->decimal('overtime_hours', 5, 2)->default(0);
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->unique(['site_manager_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_manager_attendance');
    }
};
