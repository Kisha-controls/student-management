<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'These credentials do not match our records.'])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'))->with('success', 'Welcome back, '.Auth::user()->name.'!');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    /** Self-registration creates a student account + student profile. */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email', 'unique:students,email'],
            'student_number' => ['required', 'string', 'max:50', 'unique:students,student_number'],
            'programme' => ['required', 'string', 'max:255'],
            'year_of_study' => ['required', 'integer', 'between:1,5'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);
            $user->assignRole('student');

            Student::create([
                'user_id' => $user->id,
                'student_number' => $data['student_number'],
                'name' => $data['name'],
                'email' => $data['email'],
                'programme' => $data['programme'],
                'year_of_study' => $data['year_of_study'],
            ]);

            return $user;
        });

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard')->with('success', 'Account created. Welcome!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index')->with('success', 'You have been signed out.');
    }
}
