@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-100">
    <h2 class="text-2xl font-bold mb-6 text-center">Connexion</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" class="w-full p-3 border rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Mot de passe</label>
            <input type="password" name="password" class="w-full p-3 border rounded-lg" required>
        </div>
        <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition">Se connecter</button>
    </form>
</div>
@endsection
