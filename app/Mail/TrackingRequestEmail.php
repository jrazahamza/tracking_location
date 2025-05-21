<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TrackingRequestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $message;
    /**
     * Create a new message instance.
     */

    public function __construct($token, $message)
    {
        $this->token = $token;
        $this->message = $message; // Make sure this is a plain string
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tracking Request Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        return new Content(
            view: 'emails.tracking_request', // Replace this with the actual view path.
            with: [
                'token' => $this->token,
                'user_message' => $this->message,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
