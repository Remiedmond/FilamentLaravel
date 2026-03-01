@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#FDFDFC] flex items-center justify-center px-6 py-20">
    <div class="max-w-lg w-full">

        {{-- Header --}}
        <div class="flex flex-col items-center gap-4 mb-8 text-center">
            <span class="px-3 py-1 bg-[#87a391]/10 text-[#87a391] rounded-full text-xs font-bold uppercase tracking-widest">Feedback</span>
            <h1 class="text-4xl md:text-5xl font-black text-[#1b1b18] leading-tight uppercase tracking-tighter">
                Votre avis nous intéresse !
            </h1>
            <p class="text-[#706f6c] text-sm">
                Qu'avez-vous pensé de l'événement
                <span class="font-black text-[#1b1b18] uppercase tracking-tight"> {{ $event->title }}</span> ?
            </p>
        </div>

        {{-- Card --}}
        <div class="bg-white p-8 md:p-10 rounded-[2.5rem] border border-[#e3e3e0]/50 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#87a391]/5 rounded-bl-full -z-0"></div>

            @if ($errors->any())
                <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 text-red-800 rounded-r-xl shadow-sm">
                    <p class="font-bold mb-1 text-sm">Oups ! Quelques erreurs sont survenues :</p>
                    <ul class="list-disc list-inside text-xs opacity-90">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('event.feedback.store', ['event' => $event->slug, 'registration' => $registration->id]) }}" method="POST" class="space-y-8 relative">
                @csrf

                {{-- Note --}}
                <div class="p-6 bg-[#fdfdfc] border border-[#e3e3e0] rounded-[2rem] space-y-6">
                    <label class="block text-[11px] font-bold uppercase tracking-widest text-[#706f6c] text-center">
                        Votre note sur 5
                    </label>
                    <div class="flex justify-between items-center px-2">
                        @foreach([1, 2, 3, 4, 5] as $i)
                            <label class="group cursor-pointer">
                                <input type="radio" name="rating" value="{{ $i }}" class="sr-only peer" required>
                                <div class="w-12 h-12 flex items-center justify-center rounded-full border-2 border-[#e3e3e0] text-sm font-black text-[#706f6c] transition-all duration-200
                                    peer-checked:bg-[#1b1b18] peer-checked:text-white peer-checked:border-[#1b1b18] peer-checked:shadow-lg
                                    group-hover:border-[#87a391] group-hover:text-[#87a391]">
                                    {{ $i }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Commentaire --}}
                <div class="space-y-2">
                    <label class="text-[11px] font-bold uppercase tracking-widest text-[#706f6c] ml-1">
                        Un petit mot ? <span class="text-[#87a391] normal-case font-medium tracking-normal">(optionnel)</span>
                    </label>
                    <textarea name="comment" id="comment" rows="4"
                        class="w-full px-5 py-4 bg-[#fdfdfc] border border-[#e3e3e0] rounded-2xl focus:ring-2 focus:ring-[#87a391] focus:border-transparent outline-none transition-all placeholder-[#c0c0bd] text-sm text-[#1b1b18]"
                        placeholder="Dites-nous ce qui vous a plu ou ce qu'on peut améliorer..."></textarea>
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full bg-[#1b1b18] text-white font-bold uppercase tracking-widest text-xs py-5 rounded-full hover:bg-[#87a391] shadow-xl shadow-black/10 transition-all duration-300 transform hover:scale-[1.02]">
                    Envoyer mon avis
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
