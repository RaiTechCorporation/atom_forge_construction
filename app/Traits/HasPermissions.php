<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;

trait HasPermissions
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function hasRole($roleSlug)
    {
        return $this->roles()->where('slug', $roleSlug)->exists() || $this->role === $roleSlug;
    }

    public function hasPermission($permissionSlug)
    {
        // Check if user is super admin (backward compatibility)
        if ($this->role === 'super_admin') {
            return true;
        }

        // Check if any of the user's roles have the permission
        foreach ($this->roles as $role) {
            if ($role->is_active && $role->hasPermission($permissionSlug)) {
                return true;
            }
        }

        return false;
    }

    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('slug', $role)->first();
        }

        if ($role) {
            $this->roles()->syncWithoutDetaching([$role->id]);
        }
    }

    public function removeRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('slug', $role)->first();
        }

        if ($role) {
            $this->roles()->detach($role->id);
        }
    }
}
