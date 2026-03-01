@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#FDFDFC] flex items-center justify-center px-6 py-20">
    <div class="max-w-lg w-full text-center">

        {{-- Icône de succès --}}
        <div class="flex justify-center mb-8">
            <div class="w-20 h-20 bg-[#87a391]/10 rounded-full flex items-center justify-center">
                <svg class="w-10 h-10 text-[#87a391]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>

        {{-- Badge --}}
        <div class="flex justify-center mb-4">
            <span class="px-3 py-1 bg-[#87a391]/10 text-[#87a391] rounded-full text-xs font-bold uppercase tracking-widest">Confirmation</span>
        </div>

        {{-- Titre --}}
        <h1 class="text-4xl md:text-5xl font-black text-[#1b1b18] leading-tight uppercase tracking-tighter mb-6">
            {{ $title }}
        </h1>

        {{-- Card message --}}
        <div class="bg-white border border-[#e3e3e0]/50 rounded-[2rem] shadow-sm p-8 md:p-10 space-y-4 text-left">
            <p class="text-[#706f6c] text-sm leading-relaxed">{{ $message }}</p>

            <div class="pt-4 border-t border-[#e3e3e0]/50 flex items-center gap-3">
                <div class="w-8 h-8 bg-[#f2f2f0] rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-[#87a391]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-[#706f6c] uppercase tracking-widest">Merci de votre participation !</p>
                    <p class="text-xs font-bold text-[#1b1b18]">L'équipe MyEvents</p>
                </div>
            </div>
        </div>

        {{-- Bouton retour --}}
        <div class="mt-8">
            <a href="{{ route('events.index') }}"
               class="inline-flex items-center gap-2 bg-[#1b1b18] text-white font-bold uppercase tracking-widest text-xs px-8 py-4 rounded-full hover:bg-[#87a391] shadow-xl shadow-black/10 transition-all duration-300 transform hover:scale-[1.02]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Retour à l'agenda
            </a>
        </div>

    </div>
</div>
@endsection
