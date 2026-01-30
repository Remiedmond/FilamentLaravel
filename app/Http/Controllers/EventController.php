<?php

// app/Http/Controllers/EventController.php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
         $events = Event::query()
         ->where('is_public', true)
         ->where('date-start', ">=", now())
         ->orderBy('date-start', 'asc')
         ->paginate(12);

        return view('events.index', compact('events'));
    }

    public function show(Event $event): View
    {
        abort_unless($event->is_public, 404);

        return view('events.show', compact('event'));
    }
}
