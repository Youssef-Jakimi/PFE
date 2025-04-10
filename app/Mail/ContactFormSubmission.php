<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmission extends Mailable
{
    use Queueable, SerializesModels;

    public $formData; // Data from the contact form

    public function __construct(array $formData)
    {
        $this->formData = $formData;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouveau Message Du Support', // **[CHANGE]** You can customize the subject
            to: 'youssef.jakimi@usmba.ac.ma',           // **[CHANGE]** Replace with the Gmail address where you want to receive these emails
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact', // **[MAYBE CHANGE]** If you name your email view differently
            with: ['formData' => $this->formData],
        );
    }

    public function build()
    {
        return $this;
    }
}