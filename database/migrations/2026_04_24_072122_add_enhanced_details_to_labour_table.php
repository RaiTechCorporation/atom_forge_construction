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
            $table->string('labour_unique_id')->unique()->nullable()->after('id');
            $table->string('father_name')->nullable()->after('name');
            $table->text('current_address')->nullable()->after('phone');
            $table->text('permanent_address')->nullable()->after('current_address');
            $table->string('city')->nullable()->after('permanent_address');
            $table->string('state')->nullable()->after('city');
            $table->string('pincode')->nullable()->after('state');
            $table->string('shift_type')->nullable()->after('pincode');
            $table->time('start_time')->nullable()->after('shift_type');
            $table->time('end_time')->nullable()->after('start_time');
            $table->string('break_time')->nullable()->after('end_time');
            $table->string('skill_level')->nullable()->after('work_type');
            $table->foreignId('project_id')->nullable()->after('skill_level')->constrained('projects')->onDelete('set null');
            $table->string('wage_type')->nullable()->after('wage_rate');
            $table->decimal('overtime_rate', 10, 2)->nullable()->after('wage_type');
            $table->string('aadhaar_number')->nullable()->after('overtime_rate');
            $table->string('id_proof_path')->nullable()->after('aadhaar_number');
            $table->string('photo_path')->nullable()->after('id_proof_path');
            $table->string('emergency_contact_name')->nullable()->after('photo_path');
            $table->string('emergency_contact_number')->nullable()->after('emergency_contact_name');
            $table->date('joining_date')->nullable()->after('emergency_contact_number');
            $table->string('status')->default('Active')->after('joining_date');
            $table->text('remarks')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('labour', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropColumn([
                'labour_unique_id',
                'father_name',
                'current_address',
                'permanent_address',
                'city',
                'state',
                'pincode',
                'shift_type',
                'start_time',
                'end_time',
                'break_time',
                'skill_level',
                'project_id',
                'wage_type',
                'overtime_rate',
                'aadhaar_number',
                'id_proof_path',
                'photo_path',
                'emergency_contact_name',
                'emergency_contact_number',
                'joining_date',
                'status',
                'remarks',
            ]);
        });
    }
};
