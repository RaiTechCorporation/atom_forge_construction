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
        Schema::table('projects', function (Blueprint $table) {
            $table->integer('number_of_floors')->nullable()->after('total_area_sqft');
            $table->integer('units_count')->nullable()->after('number_of_floors');
            $table->enum('construction_type', ['RCC', 'Steel', 'Prefab', 'Other'])->nullable()->after('units_count');
            $table->text('material_specifications')->nullable()->after('construction_type');
            $table->json('design_documents')->nullable()->after('material_specifications');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'number_of_floors',
                'units_count',
                'construction_type',
                'material_specifications',
                'design_documents'
            ]);
        });
    }
};
