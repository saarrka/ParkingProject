<?php

namespace App\Http\Controllers;

use Bouncer;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /*
    public function createAdmin(Request $request) {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'mobile_number' => 'required|numeric|digits_between:10,15',
        ]);

        $adminExists = Bouncer::is(User::where('email', $request->email)->first())->an('admin');

        if ($adminExists) {
            return 'Vec postoji admin u sistemu.';
        }

        $admin = User::create([
            'user_name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile_number' => $request->mobile_number
        ]);

        Bouncer::assign('admin')->to($admin);
    }
        */

    public function register(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'max:120', 'string', 'confirmed'],
            'mobile_number' => ['nullable', 'string', 'max:15'],
            'user_name' => ['required', 'string', 'min:3', 'max:120'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'mobile_number' => $request->mobile_number,
            'user_name' => $request->user_name,
        ]);

        Bouncer::assign('user')->to($user);

        Auth::login($user);

        return redirect()->route('/')->with('success', 'User created successfully!');
    }
} 
