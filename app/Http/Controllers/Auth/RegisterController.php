<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request) {
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:8',
    ]);

    $user = \App\Models\User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => \Hash::make($data['password']),
        'role' => 'employee', // Rôle par défaut
    ]);

    auth()->login($user);
    return redirect('/events');
}

    public function show() {
        return view('auth.register');
    }

    public function store(Request $request, \App\Models\Event $event)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'additional_guests' => 'required|integer|min:0|max:2',
        'allergies' => 'nullable|string',
    ]);

    $event->registrations()->create($validated);

    return back()->with('success', 'Votre inscription a bien été prise en compte !');
}
}
