<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view permissions')->only('index');
        $this->middleware('permission:edit permissions')->only('edit');
        $this->middleware('permission:create permissions')->only('create');
        $this->middleware('permission:delete permissions')->only('destroy');
    }

    public function index()
    {
        $permissions = Permission::orderBy('created_at', 'ASC')->paginate(20);
        return view('role-permission.permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('role-permission.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('permission.index')->with('success', 'Permission created successfully!');
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('role-permission.permission.edit', compact('permission'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $permission = Permission::findOrFail($id);
        $permission->name = $request->input('name');
        $permission->save();

        return redirect()->route('permission.index')->with('success', 'Permission updated successfully!');
    }


    public function destroy($permissionId)
    {
        $permission = Permission::find($permissionId);

        if (!$permission) {
            return redirect('permissions')->with('error', 'Permission not found.');
        }

        $permission->delete();

        return redirect('permissions')->with('success', 'Permission deleted successfully!');
    }
}