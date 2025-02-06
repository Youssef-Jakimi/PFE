<?php

// app/Http/Controllers/MailController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail; // If you decide to use a Mailable class later

class MailController extends Controller
{
    // Method to send the contact form email
    public function sendContactForm(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Prepare the email data
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
        ];

        // Send the email
        Mail::to('admin@example.com')->send(new ContactFormMail($data));

        // Redirect back with a success message
        return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
    }
}
