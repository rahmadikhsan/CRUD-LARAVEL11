<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{
    public function index(Request $request)
    {
        $permissions = Permission::all();
        $roles = Role::all();
        $edit = false;
        $permissionRoles = [];
        if ($request->edit) {
            // code...
            $edit = Permission::find($request->edit);
            $permissionRoles = $edit->roles->pluck('name')->toArray();
        }

        return view('admin.authorize.permissions.indexPermissions', compact('permissions', 'roles', 'edit', 'permissionRoles'));
    }

    public function update(Request $request, Permission $permission)
    {
        $permission->update([
            'name' => $request->permission,
        ]);
        $permission->syncRoles($request->roles);

        return redirect()->route('permissions.index')->with('success', 'Permission updated succesfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'permission' => 'required|min:3',
        ]);

        $permission = Permission::create([
            'name' => $request->permission,
            'quard_name' => 'web',
        ]);

        $permission->syncRoles($request->roles);

        return redirect()->route('permissions.index')->with('success', 'Permission created succesful');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Permission created succesful');
    }
}
