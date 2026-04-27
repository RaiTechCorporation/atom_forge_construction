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
        Schema::create('labour_work_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('labour_id')->constrained('labour')->onDelete('cascade');
            $table->date('date');
            $table->string('shift'); // 1st Shift, 2nd Shift, Overtime
            $table->string('file_path');
            $table->string('file_type'); // image, video
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labour_work_progress');
    }
};
