<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\Registration;
use App\Models\Feedback;
use App\Mail\EventFeedbackMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class SendEventFeedbackEmails extends Command
{
    /**
     * La signature de la commande (ce qu'on tape dans le terminal).
     */
    protected $signature = 'app:send-feedback-emails';

    protected $description = 'Envoie un email de feedback aux participants des événements terminés depuis 24h.';

    public function handle()
    {
        // On récupère les événements terminés (par exemple hier)
        $events = Event::where('date-start', '<', Carbon::now())->get();

        foreach ($events as $event) {
            // On récupère les inscriptions qui n'ont pas encore donné d'avis
            $registrations = Registration::where('event_id', $event->id)->get();

            foreach ($registrations as $registration) {
                // On vérifie en BDD si un feedback existe déjà pour cette inscription
                $alreadyHasFeedback = Feedback::where('registration_id', $registration->id)->exists();

                if (!$alreadyHasFeedback) {
                    $url = URL::temporarySignedRoute(
                        'event.feedback',
                        now()->addDays(7),
                        ['event' => $event->slug, 'registration' => $registration->id]
                    );

                    Mail::to($registration->email)->send(new EventFeedbackMail($event, $registration, $url));

                    $this->info("Email envoyé à : {$registration->email} pour l'événement : {$event->title}");
                }
            }
        }

        $this->info('Traitement terminé.');
    }
}
