<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EventRegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Event $event,
        public Registration $registration,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation d’inscription : ' . $this->event->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.registration_confirmation',
        );
    }
}
