<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionMatrixController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.permissions.matrix', compact('roles', 'permissions'));
    }

    public function update(Request $request)
    {
        $roles = Role::all();
        $permissions = Permission::all();

        foreach ($roles as $role) {
            $granted = $request->input("role_permissions.{$role->id}", []);
            $role->syncPermissions($granted);
        }

        return redirect()->route('admin.permissions.matrix')->with('success', 'Permission matrix updated successfully.');
    }
}
