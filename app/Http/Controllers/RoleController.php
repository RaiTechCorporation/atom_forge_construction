<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleController extends Controller implements HasMiddleware
{
    use LogsActivity;

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view-users', only: ['index']),
            new Middleware('permission:create-users', only: ['create', 'store']),
            new Middleware('permission:edit-users', only: ['edit', 'update', 'toggleStatus']),
            new Middleware('permission:delete-users', only: ['destroy']),
        ];
    }

    public function index()
    {
        $roles = Role::withCount('users')->paginate(10);

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all()->groupBy('module');

        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'description' => 'nullable',
            'permissions' => 'required|array',
        ]);

        DB::transaction(function () use ($request) {
            $role = Role::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'is_active' => $request->has('is_active'),
            ]);

            $role->permissions()->sync($request->permissions);

            $this->logActivity('created', $role, null, $role->toArray());
        });

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all()->groupBy('module');
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id,
            'description' => 'nullable',
            'permissions' => 'required|array',
        ]);

        $oldValues = $role->toArray();

        DB::transaction(function () use ($request, $role) {
            $role->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'is_active' => $request->has('is_active'),
            ]);

            $role->permissions()->sync($request->permissions);

            $this->logActivity('updated', $role, $oldValues, $role->toArray());
        });

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        if ($role->users()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete role assigned to users.');
        }

        $oldValues = $role->toArray();
        $role->delete();

        $this->logActivity('deleted', $role, $oldValues, null);

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }

    public function toggleStatus(Role $role)
    {
        $oldValues = $role->toArray();
        $role->is_active = ! $role->is_active;
        $role->save();

        $this->logActivity('status_toggled', $role, $oldValues, $role->toArray());

        return redirect()->back()->with('success', 'Role status updated successfully.');
    }
}
