<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Show the contact form
    public function index()
    {
        return view('contact');
    }

    // Handle form submission and send email
    public function send(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Send the email to you (the owner)
        Mail::raw("New message from: {$validatedData['name']} ({$validatedData['email']})\n\n{$validatedData['message']}", function ($message) {
            $message->to(env('MAIL_OWNER_EMAIL'))
                    ->subject('Nouveau Message Du Support YR-HOTELS');
        });

        return redirect('/contact')->with('success', 'Your message has been sent!');
    
        // Redirect back with a success message
        return back()->with('success', 'Message sent successfully!');
    }
}

