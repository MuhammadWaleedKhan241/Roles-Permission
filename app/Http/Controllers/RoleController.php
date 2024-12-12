<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view roles', ['only' => ['index']]);
        $this->middleware('permission:edit roles', ['only' => ['edit']]);
        $this->middleware('permission:create roles', ['only' => ['create']]);
        $this->middleware('permission:delete roles', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $roles = Role::when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })->paginate(5);
        return view('role-permission.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::orderBy('created_at', 'ASC')->get();
        return view('role-permission.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles|min:3',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('role.create')
                ->withInput()
                ->withErrors($validator);
        }

        // Create the role
        $role = Role::create(['name' => $request->name]);

        // Sync permissions (assign directly instead of looping)
        $role->syncPermissions($request->permission ?? []); // Default to empty array if null

        // Redirect with success message
        return redirect()
            ->route('role.index')
            ->with('success', 'Role added successfully.');
    }


    public function edit($id)
    {
        $role = Role::findOrFail($id); // Ensure $role exists
        $hasPermission = $role->permissions->pluck('name'); // Get assigned permissions
        $permissions = Permission::orderBy('created_at', 'ASC')->get(); // Retrieve all permissions

        return view('role-permission.roles.edit', compact('role', 'hasPermission', 'permissions'));
    }
    public function update(Request $request, $id)
    {
        // Find the role
        $role = Role::findOrFail($id);

        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $id . ',id|min:3',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('role.edit', $id)
                ->withInput()
                ->withErrors($validator);
        }

        // Update the role's name
        $role->name = $request->name;
        $role->save();

        // Sync permissions (assign directly)
        $role->syncPermissions($request->permission ?? []);

        // Redirect with success message
        return redirect()
            ->route('role.index')
            ->with('success', 'Role updated successfully.');
    }



    public function destroy($role)
    {
        $role = Role::findOrFail($role); // Fetch the Role model by ID
        $role->delete();
        return redirect('roles')->with('status', 'Role deleted successfully!');
    }
}