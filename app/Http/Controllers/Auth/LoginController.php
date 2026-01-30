<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
 public function login(Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->route('events.index');
    }

    return back()->withErrors(['email' => 'Identifiants incorrects.']);
}

public function logout() {
    auth()->logout();
    return redirect('/events');
}

    public function show() {
        return view('auth.login');
    }
}
