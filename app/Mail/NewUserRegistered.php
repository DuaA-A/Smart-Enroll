<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewUserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $username;

    /**
     * Create a new message instance.
     */
    public function __construct($username)
    {
        $this->username = $username;
    }

    /**
     * Get the message envelope (i.e. subject).
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New registered user',
        );
    }

    /**
     * Get the message content definition (i.e. which view to use and what data to send).
     */
    public function content(): Content
    {
        return new Content(
            view: 'new_user',  
            with: ['username' => $this->username],  
        );
    }

    /**
     * If you want to attach files, you do it here. We leave it empty.
     */
    public function attachments(): array
    {
        return [];
    }
}
