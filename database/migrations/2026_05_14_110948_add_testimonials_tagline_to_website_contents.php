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
        \App\Models\WebsiteContent::updateOrCreate(
            ['key' => 'testimonials_tagline'],
            [
                'group' => 'testimonials',
                'value' => 'Client Success',
                'type' => 'text',
                'label' => 'Testimonials Section Tagline',
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_contents', function (Blueprint $table) {
            //
        });
    }
};
