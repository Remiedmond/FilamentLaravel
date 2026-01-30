<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Événements</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 antialiased">
    <nav class="bg-white shadow-sm mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('events.index') }}" class="text-xl font-bold text-indigo-600">EventApp</a>
            <div class="flex items-center space-x-4">
                @auth
                    @if(auth()->user()->isAdmin()) {{-- Vérifie le rôle admin --}}
                        <a href="/admin" class="text-indigo-600 font-bold px-3 py-2 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition">
                            Administration
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-red-600 text-sm">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700 text-sm">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-bold">S'inscrire</a>
                @endauth
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>

    <footer class="mt-12 py-8 bg-white border-t border-gray-200 text-center text-gray-500 text-sm">
        &copy; {{ date('Y') }} EventApp - Tous droits réservés.
    </footer>
</body>
</html>
