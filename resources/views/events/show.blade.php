@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#FDFDFC] pb-20">

    <div class="max-w-4xl mx-auto px-6 pt-8">
        <a href="{{ route('events.index') }}" class="inline-flex items-center text-sm font-bold uppercase tracking-widest text-[#706f6c] hover:text-[#87a391] transition-colors group">
            <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Retour à l'agenda
        </a>
    </div>

    <div class="max-w-4xl mx-auto px-6 mt-8">
        @if ($errors->any())
            <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 text-red-800 rounded-r-xl shadow-sm">
                <p class="font-bold mb-1">Oups ! Quelques erreurs sont survenues :</p>
                <ul class="list-disc list-inside text-sm opacity-90">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex flex-col gap-4 mb-8">
            <div class="flex items-center gap-3">
                <span class="px-3 py-1 bg-[#87a391]/10 text-[#87a391] rounded-full text-xs font-bold uppercase tracking-widest">Événement</span>
                <span class="text-[#706f6c] text-sm italic">{{ \Carbon\Carbon::parse($event->getAttribute('date-start'))->translatedFormat('d F Y') }}</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-black text-[#1b1b18] leading-tight uppercase tracking-tighter">
                {{ $event->title }}
            </h1>
        </div>

        <div class="relative h-[400px] w-full rounded-[2.5rem] overflow-hidden shadow-2xl mb-12 border border-[#e3e3e0]/50">
            @if($event->cover_image)
                <img src="{{ Storage::url($event->cover_image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-[#f2f2f0] flex items-center justify-center text-[#87a391]">
                    <svg class="w-20 h-20 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            <div class="lg:col-span-1 space-y-8">
                <div class="bg-white p-8 rounded-[2rem] border border-[#e3e3e0]/50 shadow-sm">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-[#87a391] mb-6">Informations</h3>
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="p-2 bg-[#fdfdfc] rounded-lg border border-[#e3e3e0]">
                                <svg class="w-5 h-5 text-[#1b1b18]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-[#706f6c] uppercase">Lieu</p>
                                <p class="text-sm font-bold text-[#1b1b18]">{{ $event->location }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="p-2 bg-[#fdfdfc] rounded-lg border border-[#e3e3e0]">
                                <svg class="w-5 h-5 text-[#1b1b18]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-[#706f6c] uppercase">Horaires</p>
                                <p class="text-sm font-bold text-[#1b1b18]">Du {{ \Carbon\Carbon::parse($event->getAttribute('date-start'))->format('d/m/Y à H:i') }} Au {{ \Carbon\Carbon::parse($event->getAttribute('date-end'))->format('d/m/Y à H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    @php
                        $totalInscrits = $event->registrations()->sum('additional_guests') + $event->registrations()->count();
                        $disponibles = $event->max_participants - $totalInscrits;
                    @endphp

                    <div class="mt-10 pt-8 border-t border-[#e3e3e0]/50">
                        <div class="flex justify-between items-end mb-2">
                            <span class="text-[11px] font-bold text-[#706f6c] uppercase text-left">Places</span>
                            <span class="text-xs font-bold text-[#1b1b18]">{{ $totalInscrits }}/{{ $event->max_participants }}</span>
                        </div>
                        <div class="w-full bg-[#f2f2f0] h-2 rounded-full overflow-hidden">
                            <div class="bg-[#87a391] h-full transition-all duration-1000" style="width: {{ ($totalInscrits / $event->max_participants) * 100 }}%"></div>
                        </div>
                        <p class="mt-3 text-[11px] italic text-[#706f6c]">Il reste {{ $disponibles }} places disponibles</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white p-8 md:p-10 rounded-[2.5rem] border border-[#e3e3e0]/50 shadow-sm relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-[#87a391]/5 rounded-bl-full -z-0"></div>

                    <h3 class="text-2xl font-bold text-[#1b1b18] mb-8 relative">S'inscrire à l'événement</h3>

                    @if(session('success'))
                        <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center shadow-sm">
                            <svg class="w-5 h-5 mr-3 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <span class="text-sm font-bold">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('events.register', $event->slug) }}" method="POST" class="space-y-6 relative">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[11px] font-bold uppercase tracking-widest text-[#706f6c] ml-1">Nom complet</label>
                                <input type="text" name="name" required class="w-full px-5 py-4 bg-[#fdfdfc] border border-[#e3e3e0] rounded-2xl focus:ring-2 focus:ring-[#87a391] focus:border-transparent outline-none transition-all placeholder-[#c0c0bd]" placeholder="Jean Dupont">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[11px] font-bold uppercase tracking-widest text-[#706f6c] ml-1">Email</label>
                                <input type="email" name="email" required class="w-full px-5 py-4 bg-[#fdfdfc] border border-[#e3e3e0] rounded-2xl focus:ring-2 focus:ring-[#87a391] focus:border-transparent outline-none transition-all placeholder-[#c0c0bd]" placeholder="jean@exemple.fr">
                            </div>
                            <div class="md:col-span-2 space-y-2">
                                <label class="text-[11px] font-bold uppercase tracking-widest text-[#706f6c] ml-1">Allergies ou besoins spécifiques</label>
                                <textarea name="allergies" rows="2" class="w-full px-5 py-4 bg-[#fdfdfc] border border-[#e3e3e0] rounded-2xl focus:ring-2 focus:ring-[#87a391] focus:border-transparent outline-none transition-all placeholder-[#c0c0bd]" placeholder="Optionnel..."></textarea>
                            </div>
                        </div>

                        @php $maxAllowed = $event->max_guests_per_registration ?? 0; @endphp

                        <div class="pt-4">
                            <div class="p-6 bg-[#fdfdfc] border border-[#e3e3e0] rounded-[2rem] space-y-4">
                                <label class="block text-sm font-bold text-[#1b1b18]">
                                    Accompagnateurs <span class="text-[#87a391] ml-2 font-medium">(Max {{ $maxAllowed }})</span>
                                </label>
                                <select name="additional_guests" id="guests_count" class="w-full px-4 py-3 bg-white border border-[#e3e3e0] rounded-xl outline-none focus:border-[#87a391]">
                                    <option value="0">Je viens seul(e)</option>
                                    @for ($i = 1; $i <= $maxAllowed; $i++)
                                        <option value="{{ $i }}">{{ $i }} accompagnateur{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div id="guests_fields" class="space-y-4">
                            @for ($i = 0; $i < $maxAllowed; $i++)
                                <div id="guest_form_{{ $i }}" class="guest-form p-6 border border-[#e3e3e0] rounded-[2rem] bg-white shadow-sm" style="display: none;">
                                    <h4 class="text-xs font-bold uppercase tracking-widest text-[#87a391] mb-4">Accompagnateur n°{{ $i + 1 }}</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <input type="text" name="guests[{{ $i }}][firstname]" placeholder="Prénom" class="px-4 py-3 bg-[#fdfdfc] border border-[#e3e3e0] rounded-xl outline-none">
                                        <input type="text" name="guests[{{ $i }}][lastname]" placeholder="Nom" class="px-4 py-3 bg-[#fdfdfc] border border-[#e3e3e0] rounded-xl outline-none">
                                        <input type="email" name="guests[{{ $i }}][email]" placeholder="Email (optionnel)" class="md:col-span-2 px-4 py-3 bg-[#fdfdfc] border border-[#e3e3e0] rounded-xl outline-none">
                                        <textarea name="guests[{{ $i }}][allergies]" placeholder="Allergies (optionnel)" class="md:col-span-2 px-4 py-3 bg-[#fdfdfc] border border-[#e3e3e0] rounded-xl outline-none"></textarea>
                                    </div>
                                </div>
                            @endfor
                        </div>

                        <button type="submit" class="w-full bg-[#1b1b18] text-white font-bold uppercase tracking-widest text-xs py-5 rounded-full hover:bg-[#87a391] shadow-xl shadow-black/10 transition-all duration-300 transform hover:scale-[1.02]">
                            Confirmer mon inscription
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('guests_count').addEventListener('change', function() {
        const count = parseInt(this.value);
        for (let i = 0; i < {{ $maxAllowed }}; i++) {
            const field = document.getElementById('guest_form_' + i);
            if (field) {
                const isVisible = i < count;
                field.style.display = isVisible ? 'block' : 'none';
                field.querySelectorAll('input').forEach(input => {
                    if (input.type !== 'email') input.required = isVisible;
                });
            }
        }
    });
</script>
@endsection
