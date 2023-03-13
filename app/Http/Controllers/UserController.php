<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function dashboard(): View
    {
        $userRol = Auth::user()->role->description;
        return view('dashboard',["role"=>$userRol]);
    }

    public function create(): View
    {
        return view('users.form_user');
    }
    public function edit(string $id): View
    {
        $user= User::find($id);
        return view('users.form_user',["user"=>$user]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $role = Role::find(2);
        $user = $role->users()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Log::info($user);

        return Redirect::route('show_users')->with('status', 'Usuario creado');
    }
    public function update(string $id, Request $request): RedirectResponse
    {        
        $validated = $request->validate( [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($id)],
        ]);
        $user = User::find($id)->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        return Redirect::route('show_users')->with('status', 'Usuario actualizado');
    }

    public function show(Request $request): View
    {
        return view('users.show_users', [
            'users' => User::all()->load('role'),
        ]);
    }
    public function destroy(string $id): RedirectResponse
    {

        Log::info('delete');

        $user = User::find($id);
        $user->delete();

        return Redirect::route('show_users')->with('status', 'Usuario Eliminado');
    }

}
