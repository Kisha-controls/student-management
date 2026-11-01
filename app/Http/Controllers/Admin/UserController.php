<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', ['users' => User::with('roles')->orderBy('name')->paginate(10)]);
    }

    public function create()
    {
        return view('admin.users.create', ['roles' => Role::orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in(['admin', 'lecturer'])],
        ]);

        $user = User::create(['name' => $data['name'], 'email' => $data['email'], 'password' => $data['password']]);
        $user->assignRole($data['role']);

        return redirect()->route('users.index')->with('success', 'User created. (Student accounts are created from the Students page.)');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', ['user' => $user, 'roles' => Role::orderBy('name')->get()]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', Rule::exists('roles', 'name')],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if ($user->id === $request->user()->id && $data['role'] !== 'admin') {
            return back()->with('error', 'You cannot remove your own administrator access.');
        }

        $user->fill(['name' => $data['name'], 'email' => $data['email']]);
        if (! empty($data['password'])) {
            $user->password = $data['password'];
        }
        $user->save();
        $user->syncRoles([$data['role']]);

        return redirect()->route('users.index')->with('success', 'User access updated.');
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->id === $request->user()->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted.');
    }
}
