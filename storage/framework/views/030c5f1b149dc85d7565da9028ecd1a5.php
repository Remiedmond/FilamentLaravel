<!DOCTYPE html>
<html>
<body style="font-family: sans-serif; line-height: 1.6; color: #333;">
    <h2 style="color: #4f46e5;">Bonjour <?php echo e($registration->name); ?> !</h2>
    <p>Nous vous confirmons votre inscription à l'événement : <strong><?php echo e($event->title); ?></strong>.</p>

    <div style="background: #f3f4f6; padding: 15px; border-radius: 8px;">
        <p><strong> Lieu :</strong> <?php echo e($event->location); ?></p>
        <p><strong> Date :</strong> <?php echo e(\Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i')); ?></p>
        <p><strong> Accompagnants :</strong> <?php echo e($registration->additional_guests); ?></p>
    </div>
<p style="font-size: 0.9em; color: #666;">
    Un imprévu ? Vous pouvez annuler votre réservation et libérer vos places en cliquant sur le bouton ci-dessous :
</p>

<a href="<?php echo e(Illuminate\Support\Facades\URL::signedRoute('registration.cancel', ['registration' => $registration->id])); ?>"
   style="display: inline-block; padding: 10px 20px; background-color: #dc2626; color: white; text-decoration: none; border-radius: 8px; font-weight: bold;">
    Annuler ma réservation
</a>

    <p>À très bientôt,<br>L'équipe EventPro Solutions</p>
</body>
</html>
<?php /**PATH F:\LaravelS6\FilamentLaravel\resources\views/emails/registration_confirmation.blade.php ENDPATH**/ ?>