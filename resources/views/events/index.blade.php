@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#FDFDFC] font-sans text-[#1b1b18]">

    <div class="max-w-7xl mx-auto px-6 pt-12 pb-10">
        @if(session('success'))
            <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center shadow-sm">
                <svg class="w-5 h-5 mr-3 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="relative flex flex-col items-center text-center mb-16">
            <div class="absolute -top-6 w-20 h-20 bg-emerald-50 rounded-full -z-10 opacity-60"></div>

            <h1 class="text-4xl md:text-5xl font-bold text-[#1b1b18] mb-4 tracking-tight uppercase">agenda</h1>
            <div class="w-24 h-1 bg-[#87a391] rounded-full mb-6"></div> <p class="text-[#706f6c] max-w-2xl text-lg leading-relaxed">
                Découvrez les temps forts et les prochaines activités.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($events as $event)
                <div class="group bg-white rounded-[2rem] shadow-[0_10px_30px_-15px_rgba(0,0,0,0.08)] overflow-hidden border border-[#e3e3e0]/50 hover:shadow-xl hover:-translate-y-2 transition-all duration-500">

                    <div class="relative h-64 w-full">
                        @if($event->cover_image)
                            <img src="{{ asset('storage/' . $event->cover_image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="flex items-center justify-center h-full bg-[#f2f2f0] text-[#87a391]">
                                <svg class="w-16 h-16 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif

                        <div class="absolute top-0 left-6 transform">
                            <div class="bg-white px-4 py-3 shadow-md rounded-b-2xl text-center">
                                <span class="block text-2xl font-black text-[#1b1b18] leading-none">
                                    {{ \Carbon\Carbon::parse($event->getAttribute('date-start'))->format('d') }}
                                </span>
                                <span class="text-xs font-bold uppercase tracking-widest text-[#87a391]">
                                    {{ \Carbon\Carbon::parse($event->getAttribute('date-start'))->translatedFormat('M') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="p-8">
                        <div class="flex items-center mb-3">
                            <span class="w-2 h-2 rounded-full bg-[#f53003] mr-2"></span> <span class="text-[11px] font-bold uppercase tracking-wider text-[#706f6c]">Vie associative & Sports</span>
                        </div>

                        <h2 class="text-2xl font-bold text-[#1b1b18] mb-4 leading-tight group-hover:text-[#87a391] transition-colors line-clamp-2">
                            {{ $event->title }}
                        </h2>

                        <div class="flex flex-col gap-2 mb-8">
                            <div class="flex items-center text-[#706f6c] text-sm italic">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                {{ $event->location }}
                            </div>
                        </div>

                        <a href="{{ route('events.show', $event->slug) }}" class="inline-flex items-center justify-center w-full px-6 py-3 text-sm font-bold tracking-widest uppercase text-white bg-[#1b1b18] rounded-full hover:bg-[#87a391] transition-all duration-300 shadow-lg shadow-black/10">
                            En savoir plus
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white rounded-[2rem] p-20 text-center border-2 border-dashed border-[#e3e3e0]">
                    <p class="text-[#706f6c] text-xl italic">Pas d'événements prévus pour le moment.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-16 flex justify-center">
            {{ $events->links() }}
        </div>
    </div>

    <div class="w-full h-24 bg-[#87a391]/10 mt-12" style="clip-path: ellipse(80% 100% at 50% 100%);"></div>
</div>
@endsection
