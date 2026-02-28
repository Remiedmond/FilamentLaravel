<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\URL;
use App\Models\Event;
use App\Http\Controllers\FeedbackController;

// --- AUTHENTIFICATION ---
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// --- ACCUEIL ---
Route::get('/', function () {
    return redirect()->route('events.index');
});

// --- ÉVÉNEMENTS (PUBLIC & INVITATIONS) ---
Route::get('/events', [EventController::class, 'index'])->name('events.index');

/** * On utilise {event:slug} ici.
 * Cela permet d'accéder à /events/reunion-automne au lieu de /events/24.
 * La vérification de signature pour les privés est faite dans le EventController.
 */
Route::get('/events/{event:slug}', [EventController::class, 'show'])->name('events.show');

// --- INSCRIPTIONS ---
Route::post('/events/{event:slug}/register', [RegistrationController::class, 'store'])->name('events.register');

/**
 * Annulation sécurisée par signature.
 * Le middleware 'signed' bloque l'accès si la signature dans l'email est modifiée.
 */
Route::get('/registration/{registration}/cancel', [RegistrationController::class, 'cancel'])
    ->name('registration.cancel')
    ->middleware('signed');

// --- ADMINISTRATION (EXPORT CSV) ---
Route::get('/admin/events/{event}/export-csv', function (Event $event) {
    if (!auth()->user() || !auth()->user()->isAdmin()) {
        abort(403);
    }

    $fileName = 'inscriptions-' . $event->slug . '.csv';
    $registrations = $event->registrations;

    $headers = [
        "Content-type"        => "text/csv; charset=UTF-8",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    ];

    $columns = ['Nom', 'Email', 'Accompagnants', 'Allergies', 'Date d\'inscription'];

    $callback = function() use($registrations, $columns) {
        $file = fopen('php://output', 'w');
        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF)); // BOM UTF-8
        fputcsv($file, $columns, ';');

        foreach ($registrations as $reg) {
            fputcsv($file, [
                $reg->name,
                $reg->email,
                $reg->additional_guests,
                $reg->allergies ?? 'Aucune',
                $reg->created_at->format('d/m/Y H:i')
            ], ';');
        }
        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
})->name('events.export');


Route::get('/events/{event:slug}/feedback/{registration}', [FeedbackController::class, 'create'])
    ->name('event.feedback')
    ->middleware('signed');

// 2. Traitement du formulaire (Enregistrement en base de données)
Route::post('/events/{event:slug}/feedback/{registration}', [FeedbackController::class, 'store'])
    ->name('event.feedback.store');
