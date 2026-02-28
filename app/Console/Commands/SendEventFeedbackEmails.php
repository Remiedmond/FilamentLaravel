<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Mail\EventFeedbackMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendEventFeedbackEmails extends Command
{
    /**
     * Signature de la commande (à utiliser dans schedule).
     */
    protected $signature = 'app:send-feedback-emails';

    /**
     * Description de la commande.
     */
    protected $description = 'Envoie des emails de demande d\'avis 24h après la fin d\'un événement';

    public function handle()
    {
        // On cible les événements terminés hier (entre 24h et 48h)
        $startRange = Carbon::now()->subDays(2)->startOfDay();
        $endRange = Carbon::now()->subDay()->endOfDay();

        $events = Event::query()
            ->whereBetween('date-end', [$startRange, $endRange])
            ->with('registrations')
            ->get();

        if ($events->isEmpty()) {
            $this->info('Aucun événement terminé hier à traiter.');
            return;
        }

        foreach ($events as $event) {
            foreach ($event->registrations as $registration) {
                // On n'envoie que si le feedback n'existe pas encore
                $exists = \App\Models\Feedback::where('registration_id', $registration->id)->exists();

                if (!$exists) {
                    Mail::to($registration->email)->send(new EventFeedbackMail($event, $registration));
                }
            }
            $this->info("Emails envoyés pour : {$event->title}");
        }

        $this->info('Traitement terminé.');
    }
}
