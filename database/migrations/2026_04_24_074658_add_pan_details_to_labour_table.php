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
        Schema::table('labour', function (Blueprint $table) {
            $table->string('pan_number')->nullable()->after('aadhaar_number');
            $table->string('pan_proof_path')->nullable()->after('id_proof_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('labour', function (Blueprint $table) {
            $table->dropColumn(['pan_number', 'pan_proof_path']);
        });
    }
};
