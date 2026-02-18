<div class="container">
<h2>Bonjour !</h2>
<p>Marie Dupont vous invite à participer à un événement exclusif sur <strong>MyEvents</strong>.</p>

    <div class="event-card">
        <h3 style="margin-top: 0; color: #4CAF50;">{{ $event->title }}</h3>
        <p><strong>Lieu :</strong> {{ $event->location }}</p>
        {{-- Utilisation de date-start ou start_date selon votre base de données --}}
        <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($event['date-start'] ?? $event->start_date)->format('d/m/Y H:i') }}</p>
    </div>

    <p>Cet événement est privé. Pour réserver votre place, veuillez cliquer sur le bouton sécurisé ci-dessous :</p>

    <p style="text-align: center; margin: 30px 0;">
        {{--
            IMPORTANT : On utilise le slug ici pour correspondre à la route /events/{event:slug}
            La signature garantit que l'accès est autorisé même si l'event est privé.
        --}}
        <a href="{{ URL::signedRoute('events.show', ['event' => $event->slug]) }}" class="button">
            Voir l'événement et s'inscrire
        </a>
    </p>

    <p>À bientôt !<br>L'équipe MyEvents</p>
</div>
