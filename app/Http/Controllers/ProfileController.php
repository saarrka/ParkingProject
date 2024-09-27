<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        // Vraća view za editovanje profila, prosleđuje trenutnog korisnika
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
    
        // Validacija
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'min:3', 'max:120'],
            'mobile_number' => ['nullable', 'string', 'max:15'],
            'password' => ['required_with:new_password', 'string', 'min:8'], // Proverava da li je trenutna lozinka unesena ako je nova postavljena
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed'], // Potvrda nove lozinke
        ]);
    
        // Proveri da li je trenutna lozinka tačna
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Current password is incorrect.']);
        }
    
        // Ažuriraj korisničke podatke
        $user->name = $request->name;
        $user->user_name = $request->user_name;
        $user->mobile_number = $request->mobile_number;
    
        // Ažuriraj lozinku ako je nova lozinka postavljena i potvrđena
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password); // Koristi Hash::make
        }
    
        // Sačuvaj promene
        $user->save();
    
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
