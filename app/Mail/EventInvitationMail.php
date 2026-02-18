<?php

namespace App\Mail;

// C'est cet import qui manquait pour résoudre le conflit de type
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EventInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Le constructeur reçoit maintenant le bon type d'objet.
     */
    public function __construct(
        public Event $event
    ) {}

    /**
     * Définit l'enveloppe du mail (Sujet).
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invitation exclusive : ' . $this->event->title,
        );
    }

    /**
     * Définit le contenu du mail (Vue Blade).
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.event-invitation',
        );
    }
}
