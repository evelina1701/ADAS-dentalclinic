<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // Display a list of users
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Show the form for creating a new user
    public function create()
    {
        // Define available roles
        $roles = ['admin', 'receptionist', 'dentist'];
            // Provide an empty User object
        $user = new User();
        return view('admin.users.create', compact('roles', 'user'));
    }

    // Store a new user in the database
    public function store(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'surname'               => 'required|string|max:255',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:6|confirmed',
            'role'                  => 'required|in:admin,receptionist,dentist',
        ]);

        //dd($request->all());

        $user = User::create([
            'name'     => $request->name,
            'surname'  => $request->surname,
            'email'    => $request->email,
            //'role'     => $request->role,
            'password' => Hash::make($request->password),
        ]);

        // Assign the chosen role using Spatie
        $user->assignRole($request->role);

        return redirect()->route('admin.users.index')
                         ->with('success', 'User created successfully.');
    }

    // Show the form for editing the specified user
    public function edit(User $user)
    {
        $roles = ['admin', 'receptionist', 'dentist'];
        return view('admin.users.edit', compact('user', 'roles'));
    }

    // Update the specified user in storage
    public function update(Request $request, User $user)
{
    $rules = [
        'name'  => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required|in:admin,receptionist,dentist,manager', 
        // or you might keep it if you want to validate the incoming role name
    ];

    if ($request->filled('password')) {
        $rules['password'] = 'min:6|confirmed';
    }

    $request->validate($rules);

    $user->name  = $request->name;
    $user->surname = $request->surname;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    // Now assign or sync the role via Spatie:
    // If your form sends a single role, you can do:
    $user->syncRoles([$request->role]);

    return redirect()->route('admin.users.index')
        ->with('success', 'User updated successfully.');
}

    // Remove the specified user from storage
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')
                         ->with('success', 'User deleted successfully.');
    }
}
