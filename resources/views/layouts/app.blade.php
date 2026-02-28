<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Saint-Pierre-la-Cour') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-[#FDFDFC] text-[#1b1b18] flex flex-col min-h-full">

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-[#e3e3e0]/50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

            <a href="{{ route('events.index') }}" class="flex items-center gap-2 group">
                <div class="w-10 h-10 bg-[#87a391] rounded-xl flex items-center justify-center text-white font-bold group-hover:rotate-6 transition-transform">
                    My
                </div>
                <span class="text-xl font-black uppercase tracking-tighter text-[#1b1b18]">
                    Event<span class="text-[#87a391]">App</span>
                </span>
            </a>

            <div class="flex items-center gap-6">
                @auth
                    <div class="hidden sm:flex flex-col items-end text-right">
                        <span class="text-[11px] font-bold uppercase tracking-widest text-[#706f6c]">Utilisateur</span>
                        <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                    </div>

                    @if(auth()->user()->isAdmin())
                        <a href="/admin" class="bg-[#87a391]/10 text-[#87a391] px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-[#87a391] hover:text-white transition-all duration-300 border border-[#87a391]/20">
                            Administration
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="p-2 text-[#706f6c] hover:text-[#f53003] transition-colors" title="Déconnexion">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold uppercase tracking-widest text-[#706f6c] hover:text-[#1b1b18] transition-colors">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}" class="bg-[#1b1b18] text-white px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-[#87a391] transition-all duration-300 shadow-lg shadow-black/10">
                        S'inscrire
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-[#e3e3e0]/50 py-12">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-[#87a391]/20 rounded-lg flex items-center justify-center text-[#87a391] font-bold text-xs">
                    MY
                </div>
                <p class="text-[13px] font-bold uppercase tracking-widest text-[#706f6c]">
                    &copy; {{ date('Y') }} — EventApp. Tous droits réservés.
                </p>
            </div>


        </div>
    </footer>

</body>
</html>
