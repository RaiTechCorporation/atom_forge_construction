<?php

namespace Database\Seeders;

use App\Models\Investor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@construction.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
        ]);

        // Admin Staff
        User::create([
            'name' => 'Staff Member',
            'email' => 'staff@construction.com',
            'password' => Hash::make('password'),
            'role' => 'admin_staff',
        ]);

        // Client
        User::create([
            'name' => 'John Client',
            'email' => 'client@example.com',
            'password' => Hash::make('password'),
            'role' => 'client',
        ]);

        // Investor
        $investorUser = User::create([
            'name' => 'Jane Investor',
            'email' => 'investor@example.com',
            'password' => Hash::make('password'),
            'role' => 'investor',
        ]);

        Investor::create([
            'user_id' => $investorUser->id,
            'name' => 'Jane Investor',
            'phone' => '1234567890',
            'status' => 'active',
        ]);
    }
}
