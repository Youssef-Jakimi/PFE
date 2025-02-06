<?php

// app/Http/Controllers/ContactController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        // Process the data (e.g., send an email, save to database, etc.)
        // Example: Send an email
        // Mail::to('admin@example.com')->send(new ContactFormMail($request->all()));

        // Redirect back with a success message
        return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
    }
}
