<div class="container">
<h2>Bonjour !</h2>
<p>Marie Dupont vous invite à participer à un événement exclusif sur <strong>MyEvents</strong>.</p>

    <div class="event-card">
        <h3 style="margin-top: 0; color: #4CAF50;"><?php echo e($event->title); ?></h3>
        <p><strong>Lieu :</strong> <?php echo e($event->location); ?></p>
        
        <p><strong>Date :</strong> <?php echo e(\Carbon\Carbon::parse($event['date-start'] ?? $event->start_date)->format('d/m/Y H:i')); ?></p>
    </div>

    <p>Cet événement est privé. Pour réserver votre place, veuillez cliquer sur le bouton sécurisé ci-dessous :</p>

    <p style="text-align: center; margin: 30px 0;">
        
        <a href="<?php echo e(URL::signedRoute('events.show', ['event' => $event->slug])); ?>" class="button">
            Voir l'événement et s'inscrire
        </a>
    </p>

    <p>À bientôt !<br>L'équipe MyEvents</p>
</div>
<?php /**PATH F:\LaravelS6\FilamentLaravel\resources\views/emails/event-invitation.blade.php ENDPATH**/ ?>