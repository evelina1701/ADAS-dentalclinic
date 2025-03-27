<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // List all roles
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    // Show form for editing role permissions
    public function edit(Role $role)
    {
        // Retrieve all available permissions from Spatie's Permission model
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    // Update role permissions
    public function update(Request $request, Role $role)
    {
        // Validate that the permissions are provided as an array (optional)
        $request->validate([
            'permissions' => 'array',
        ]);

        // Sync the role's permissions with the provided permissions
        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.index')
                         ->with('success', 'Role updated successfully.');
    }
}
