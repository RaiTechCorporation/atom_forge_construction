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
        Schema::table('labour_work_progress', function (Blueprint $table) {
            $table->dropForeign(['labour_id']);
            $table->renameColumn('labour_id', 'site_manager_id');
            $table->foreign('site_manager_id')->references('id')->on('site_managers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('labour_work_progress', function (Blueprint $table) {
            $table->dropForeign(['site_manager_id']);
            $table->renameColumn('site_manager_id', 'labour_id');
            $table->foreign('labour_id')->references('id')->on('labour')->onDelete('cascade');
        });
    }
};
