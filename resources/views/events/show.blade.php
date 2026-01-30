{{-- resources/views/events/show.blade.php --}}
<h1>{{ $event->title }}</h1>

<div class="event-details">
    <p><strong>Lieu :</strong> {{ $event->location }}</p>
    <p><strong>Date de début :</strong> {{ $event->getAttribute('date-start') }}</p>

    @if($event->cover_image)
        <img src="{{ Storage::url($event->cover_image) }}" alt="{{ $event->title }}" style="max-width: 500px;">
    @endif

    <div class="description">
        {{-- Affichez ici d'autres colonnes si nécessaire --}}
        <p>Places maximum : {{ $event->max_participants }}</p>
    </div>
</div>

<a href="{{ route('events.index') }}">Retour à la liste</a>
