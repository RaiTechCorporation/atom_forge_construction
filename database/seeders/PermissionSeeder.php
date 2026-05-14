<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Users module
            ['name' => 'View Users', 'slug' => 'view-users', 'module' => 'Users'],
            ['name' => 'Create Users', 'slug' => 'create-users', 'module' => 'Users'],
            ['name' => 'Edit Users', 'slug' => 'edit-users', 'module' => 'Users'],
            ['name' => 'Delete Users', 'slug' => 'delete-users', 'module' => 'Users'],

            // Projects module
            ['name' => 'View Projects', 'slug' => 'view-projects', 'module' => 'Projects'],
            ['name' => 'Create Projects', 'slug' => 'create-projects', 'module' => 'Projects'],
            ['name' => 'Edit Projects', 'slug' => 'edit-projects', 'module' => 'Projects'],
            ['name' => 'Delete Projects', 'slug' => 'delete-projects', 'module' => 'Projects'],

            // CMS / Media module
            ['name' => 'View Media/CMS', 'slug' => 'view-media', 'module' => 'CMS'],
            ['name' => 'Upload Media', 'slug' => 'upload-media', 'module' => 'CMS'],
            ['name' => 'Edit Website Content', 'slug' => 'edit-content', 'module' => 'CMS'],

            // Attendance module
            ['name' => 'View Attendance', 'slug' => 'view-attendance', 'module' => 'Attendance'],
            ['name' => 'Mark Attendance', 'slug' => 'mark-attendance', 'module' => 'Attendance'],
            ['name' => 'Edit Attendance', 'slug' => 'edit-attendance', 'module' => 'Attendance'],

            // Finance module
            ['name' => 'View Expenses', 'slug' => 'view-expenses', 'module' => 'Finance'],
            ['name' => 'Create Expenses', 'slug' => 'create-expenses', 'module' => 'Finance'],
            ['name' => 'View Payouts', 'slug' => 'view-payouts', 'module' => 'Finance'],
            ['name' => 'Approve Payouts', 'slug' => 'approve-payouts', 'module' => 'Finance'],

            // Dashboard
            ['name' => 'View Dashboard', 'slug' => 'view-dashboard', 'module' => 'System'],
            ['name' => 'View Settings', 'slug' => 'view-settings', 'module' => 'System'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['slug' => $permission['slug']], $permission);
        }
    }
}
