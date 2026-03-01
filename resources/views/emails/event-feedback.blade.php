<div class="min-h-screen bg-[#FDFDFC] flex items-center justify-center px-6 py-20">
    <div class="max-w-lg w-full">

        <div class="flex flex-col items-center gap-4 mb-8 text-center">
            <span class="px-3 py-1 bg-[#87a391]/10 text-[#87a391] rounded-full text-xs font-bold uppercase tracking-widest">MyEvents</span>
            <h2 class="text-4xl md:text-5xl font-black text-[#1b1b18] leading-tight uppercase tracking-tighter">
                Bonjour !
            </h2>
        </div>

        <div class="bg-white p-8 md:p-10 rounded-[2.5rem] border border-[#e3e3e0]/50 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#87a391]/5 rounded-bl-full"></div>

            <div class="relative space-y-6">

                <p class="text-[#706f6c] text-sm leading-relaxed">
                    Merci d'avoir participé à l'événement
                    <span class="font-black text-[#1b1b18] uppercase tracking-tight">{{ $event->title }}</span>.
                </p>

                <p class="text-[#706f6c] text-sm leading-relaxed">
                    Votre avis est précieux pour nous aider à améliorer nos futurs événements. Pourriez-vous prendre une minute pour nous donner votre retour ?
                </p>

                <div class="flex justify-center pt-4">
                    <a href="{{ $url }}"
                       class="inline-flex items-center gap-2 bg-[#1b1b18] text-white font-bold uppercase tracking-widest text-xs px-10 py-5 rounded-full hover:bg-[#87a391] shadow-xl shadow-black/10 transition-all duration-300 transform hover:scale-[1.02]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                        Donner mon avis
                    </a>
                </div>

                <div class="pt-6 border-t border-[#e3e3e0]/50 flex items-center gap-3">
                    <div class="w-8 h-8 bg-[#f2f2f0] rounded-full flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-[#87a391]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-[#706f6c] uppercase tracking-widest">Merci de votre participation !</p>
                        <p class="text-xs font-black text-[#1b1b18]">L'équipe MyEvents</p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
