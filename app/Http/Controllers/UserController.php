<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller
{
    public function __construct()
    {
        // Apply the permission middleware to specific methods
        //$this->middleware('permission:view users')->only('index'); // Only allow 'view users' permission for the index method
        //$this->middleware('permission:edit users')->only('edit'); // Only allow 'edit users' permission for the edit method
        //$this->middleware('permission:create users')->only('create'); // Only allow 'create users' permission for the create method
        //$this->middleware('permission:delete users')->only('destroy'); // Only allow 'delete users' permission for the destroy method
    }


    public function index()
    {
        $users = User::latest()->paginate(3);
        return view('role-permission.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::orderBy('name', 'ASC')->get();

        return view('role-permission.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|max:12|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        // Check if validation passed and data is being handled properly
        if ($validator->fails()) {

            return redirect()->route('users.create')->withInput()->withErrors($validator);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->passowrd);

        $user->save();

        $user->syncRoles($request->role);
        return redirect()->route('users.index')->with('success', 'User added successfully.');
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        $roles = Role::orderBy('name', 'ASC')->get();
        $hasRoles = $user->roles->pluck('id');
        return view('role-permission.users.edit', compact('user', 'roles', 'hasRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id . ',id'
        ]);

        // Check if validation passed and data is being handled properly
        if ($validator->fails()) {

            return redirect()->route('users.edit', $id)->withInput()->withErrors($validator);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $user->syncRoles($request->role);
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the article by id
        $user = User::findOrFail($id);

        // Delete the article
        $user->delete();

        // Redirect back with a success message
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}