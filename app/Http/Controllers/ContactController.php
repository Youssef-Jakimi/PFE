<?php

// app/Http/Controllers/ContactController.php

namespace App\Http\Controllers;

use App\Models\mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    // Display the contact form
    public function index()
    {
        return view('contact');
    }

    // Handle form submission (optional)
    public function send(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);
        $mail = new mail();
        $mail->email=$request->input('email');
        $mail->message=$request->input('message');
        $mail->Utilisateur=Auth::id();
        $mail->save();

        // Redirect back with a success message
        return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
    }
}
