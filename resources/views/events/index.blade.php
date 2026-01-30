@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
        <div>
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Prochains Événements</h1>
            <p class="text-gray-500 mt-2">Découvrez et participez aux meilleurs événements de votre région.</p>
        </div>
        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100">
            {{ $events->total() }} événements à venir
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($events as $event)
            <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                {{-- Image avec effet au survol --}}
                <div class="relative h-52 w-full overflow-hidden">
                    @if($event->cover_image)
                        <img src="{{ Storage::url($event->cover_image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="flex items-center justify-center h-full bg-gradient-to-br from-gray-100 to-gray-200 text-gray-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="bg-white/90 backdrop-blur px-3 py-1 rounded-lg shadow-sm text-xs font-bold text-gray-900 uppercase">
                            {{ \Carbon\Carbon::parse($event->getAttribute('date-start'))->translatedFormat('d M') }}
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-1 group-hover:text-indigo-600 transition-colors">
                        {{ $event->title }}
                    </h2>

                    <div class="space-y-2 mb-6">
                        <div class="flex items-center text-gray-500 text-sm">
                            <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $event->location }}
                        </div>
                        <div class="flex items-center text-gray-500 text-sm">
                            <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ \Carbon\Carbon::parse($event->getAttribute('date-start'))->translatedFormat('H:i') }}
                        </div>
                    </div>

                    <a href="{{ route('events.show', $event->slug) }}" class="flex items-center justify-center w-full px-5 py-3 text-sm font-bold text-white bg-gray-900 rounded-xl hover:bg-indigo-600 transition-colors duration-300 shadow-sm">
                        Voir l'événement
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl p-12 text-center border-2 border-dashed border-gray-200">
                <p class="text-gray-500 text-lg">Aucun événement n'est disponible pour le moment.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-12">
        {{ $events->links() }}
    </div>
</div>
@endsection
