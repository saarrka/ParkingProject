<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact'); 
    }

    // Funkcija za obradu kontaktnog formulara
    public function submit(Request $request)
    {
        // Validacija podataka
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);
 
        //Mail::to('srmljkvc@gmail.com')->send(new ContactFormMail($validatedData));

        return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
    }
}
