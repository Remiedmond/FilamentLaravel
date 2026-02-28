<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Affiche le formulaire (Signature vérifiée par middleware).
     */
    public function create(Request $request, Event $event, Registration $registration)
    {
        // SÉCURITÉ : On vérifie que cette inscription appartient bien à cet événement
        if ($registration->event_id !== $event->id) {
            abort(403, "Cette inscription ne correspond pas à cet événement.");
        }

        // Vérification si le feedback existe déjà
        if (Feedback::where('registration_id', $registration->id)->exists()) {
            return view('feedback.thanks', [
                'title' => 'Avis déjà reçu',
                'message' => 'Merci ! Nous avons déjà enregistré votre retour pour cet événement.'
            ]);
        }

        return view('feedback.form', compact('event', 'registration'));
    }

    /**
     * Enregistre le feedback en base de données.
     */
    public function store(Request $request, Event $event, Registration $registration)
    {
        // SÉCURITÉ : On vérifie aussi lors de l'envoi
        if ($registration->event_id !== $event->id) {
            abort(403);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Feedback::create([
            'event_id' => $event->id,
            'registration_id' => $registration->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return view('feedback.thanks', [
            'title' => 'Merci beaucoup !',
            'message' => 'Votre avis a bien été pris en compte. À bientôt !'
        ]);
    }
}
