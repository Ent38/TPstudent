<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\StoreRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function index()
    {
        Gate::authorize('view_roles');
        $roles = Role::all();
        $permissions = Permission::all();

        return view('josue.backend.roles.index', compact('roles', 'permissions'));
    }

    public function create()
    {
        Gate::authorize('add_roles');
    }

    public function store(StoreRoleRequest $request)
    {
        Gate::authorize('add_roles');

        if (Role::create($request->only('name'))) {
            $status = 'Role Created Successfully';
        }

        return redirect()->back()->with([
            'status' => $status,
        ]);
    }

    public function show($id)
    {
        Gate::authorize('view_roles');
    }

    public function edit($id)
    {
        Gate::authorize('edit_roles');
    }

    public function update(Request $request, Role $role)
    {
        Gate::authorize('edit_roles');

        if ($role->name === 'Admin') {
            $role->syncPermissions(Permission::all());

            return redirect()->route('roles.index');
        }

        $permissions = $request->get('permissions', []);
        $role->syncPermissions($permissions);
        $status = ' permissions has been updated';

        return redirect()->route('roles.index')->with([
            'status' => $status,
        ]);
    }

    public function destroy(Role $role)
    {
        Gate::authorize('delete_roles');

        if ($role->delete()) {
            $status = 'Role Deleted Successfully';
        } else {
            $status = 'Role Fail to delete';
        }

        return redirect()->back()->with([
            'status' => $status, ]);
    }
}
