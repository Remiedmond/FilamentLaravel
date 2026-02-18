<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Liste des événements publics à venir.
     */
    public function index(): View
    {
         $events = Event::query()
             ->where('is_public', true)
             ->where('date-start', ">=", now())
             ->orderBy('date-start', 'asc')
             ->paginate(12);

        return view('events.index', compact('events'));
    }

    /**
     * Affiche un événement spécifique.
     * Si l'événement est privé, il nécessite une signature valide dans l'URL.
     */
    public function show(Event $event): View
    {
        // Sécurité : Accès autorisé si l'événement est public
        // OU si le lien possède une signature Laravel valide (générée par signedRoute)
        abort_unless(
            $event->is_public || request()->hasValidSignature(),
            403,
            "Cet événement est privé ou votre lien d'invitation n'est plus valide."
        );

        // Calcul du remplissage
        $registrationsCount = $event->registrations()->count();
        $additionalGuestsCount = (int) $event->registrations()->sum('additional_guests');
        $totalParticipants = $registrationsCount + $additionalGuestsCount;

        $isFull = $event->max_participants && $totalParticipants >= $event->max_participants;

        return view('events.show', compact('event', 'isFull'));
    }
}
