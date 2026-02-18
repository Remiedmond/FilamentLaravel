<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventRegistrationConfirmation;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;


class RegistrationController extends Controller
{
    public function store(Request $request, Event $event)
    {
        // 1. Calculer combien de personnes tentent de s'inscrire
        $newGuestsCount = (int) $request->input('additional_guests', 0);
        $totalNewParticipants = 1 + $newGuestsCount; // +1 pour la personne qui remplit le formulaire

        // 2. Calculer combien de places sont déjà prises
        // On somme l'inscrit principal (1) + ses accompagnateurs (additional_guests)
        $currentParticipantsCount = $event->registrations()->sum('additional_guests') + $event->registrations()->count();

        // 3. Vérifier si le quota est dépassé
        if ($event->max_participants && ($currentParticipantsCount + $totalNewParticipants) > $event->max_participants) {
            $remainingPlaces = $event->max_participants - $currentParticipantsCount;

            throw ValidationException::withMessages([
                'event_full' => "Désolé, il ne reste que $remainingPlaces place(s) disponible(s) pour cet événement."
            ]);
        }

        // 4. Validation classique
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('registrations')->where(fn ($query) => $query->where('event_id', $event->id))
            ],
            'additional_guests' => [
                'required',
                'integer',
                'min:0',
                'max:' . ($event->max_guests_per_registration ?? 0)
            ],
            'allergies' => 'nullable|string',
            'guests' => 'nullable|array',
            'guests' => 'nullable|array',
            'guests.*.firstname' => 'nullable|required_with:guests.*.lastname|string|max:255',
            'guests.*.lastname' => 'nullable|required_with:guests.*.firstname|string|max:255',
            'guests.*.email' => 'nullable|email',
            'guests.*.allergies' => 'nullable|string',
        ], [
            'email.unique' => 'Désolé, vous êtes déjà inscrit à cet événement avec cette adresse email.',
        ]);

        // 5. Création de l'inscription
        $registration = $event->registrations()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'additional_guests' => $validated['additional_guests'],
            'allergies' => $request->input('allergies'),
            'guests_details' => $request->input('guests'),
        ]);

        // 6. Envoi du mail
        Mail::to($registration->email)->send(new EventRegistrationConfirmation($event, $registration));

        return back()->with('success', 'Votre inscription a bien été prise en compte !');
    }

    public function cancel(Request $request, \App\Models\Registration $registration)
{
    $eventTitle = $registration->event->title;

    $registration->delete();

    return redirect()->route('events.index')
        ->with('success', "Votre réservation pour l'événement '{$eventTitle}' a été annulée avec succès.");
}
}
