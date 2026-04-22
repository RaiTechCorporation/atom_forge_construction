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
        \DB::table('website_contents')->insert([
            [
                'group' => 'email_config',
                'key' => 'is_smtp',
                'value' => '1',
                'type' => 'boolean',
                'label' => 'SMTP Status',
            ],
            [
                'group' => 'email_config',
                'key' => 'smtp_host',
                'value' => 'in-v3.mailjet.com',
                'type' => 'text',
                'label' => 'SMTP Host',
            ],
            [
                'group' => 'email_config',
                'key' => 'smtp_port',
                'value' => '587',
                'type' => 'text',
                'label' => 'SMTP Port',
            ],
            [
                'group' => 'email_config',
                'key' => 'smtp_user',
                'value' => '0e05029e2dc70da691aa2223aa53c5be',
                'type' => 'text',
                'label' => 'SMTP Username',
            ],
            [
                'group' => 'email_config',
                'key' => 'smtp_pass',
                'value' => '5df1b6242e86bce602c3fd9adc178460',
                'type' => 'text',
                'label' => 'SMTP Password',
            ],
            [
                'group' => 'email_config',
                'key' => 'from_email',
                'value' => 'admin@geniusocean.com',
                'type' => 'text',
                'label' => 'From Email',
            ],
            [
                'group' => 'email_config',
                'key' => 'from_name',
                'value' => 'GeniusOcean',
                'type' => 'text',
                'label' => 'From Name',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \DB::table('website_contents')->where('group', 'email_config')->delete();
    }
};
