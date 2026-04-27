<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RBACSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            'Dashboard' => ['View'],
            'Users' => ['View', 'Create', 'Edit', 'Delete'],
            'Employees' => ['View', 'Create', 'Edit', 'Delete'],
            'Projects' => ['View', 'Create', 'Edit', 'Delete', 'Assign Staff'],
            'Attendance' => ['View', 'Manage'],
            'Payroll' => ['View', 'Create', 'Edit', 'Approve'],
            'Inventory' => ['View', 'Add', 'Edit', 'Delete'],
            'Vendors' => ['View', 'Create', 'Edit', 'Delete'],
            'Reports' => ['View', 'Export'],
            'Settings' => ['View', 'Update'],
            'Media' => ['View', 'Upload', 'Delete'],
        ];

        $permissionIds = [];
        foreach ($modules as $module => $actions) {
            foreach ($actions as $action) {
                $name = $action.' '.$module;
                $slug = Str::slug($name);
                $permission = Permission::updateOrCreate(
                    ['slug' => $slug],
                    ['name' => $name, 'module' => $module]
                );
                $permissionIds[] = $permission->id;
            }
        }

        // Create Super Admin Role
        $superAdmin = Role::updateOrCreate(
            ['slug' => 'super-admin'],
            ['name' => 'Super Admin', 'description' => 'Has all permissions', 'is_active' => true]
        );
        $superAdmin->permissions()->sync($permissionIds);

        // Create a default Admin Role
        $admin = Role::updateOrCreate(
            ['slug' => 'admin'],
            ['name' => 'Admin', 'description' => 'Standard administrator', 'is_active' => true]
        );
        // Sync all for now, can be restricted later
        $admin->permissions()->sync($permissionIds);
    }
}
