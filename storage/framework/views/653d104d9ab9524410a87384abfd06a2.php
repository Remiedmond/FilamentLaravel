<?php $__env->startSection('content'); ?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-xl">
        <ul>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <li><?php echo e($error); ?></li>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </ul>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<h1><?php echo e($event->title); ?></h1>

<div class="event-details">
    <p><strong>Lieu :</strong> <?php echo e($event->location); ?></p>
    <p><strong>Date de début :</strong> <?php echo e($event->getAttribute('date-start')); ?></p>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->cover_image): ?>
        <img src="<?php echo e(Storage::url($event->cover_image)); ?>" alt="<?php echo e($event->title); ?>" style="max-width: 500px;">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
     <p><strong>Date de fin :</strong> <?php echo e($event->getAttribute('date-end')); ?></p>

    <div class="description">
    
    <?php
        $totalInscrits = $event->registrations()->sum('additional_guests') + $event->registrations()->count();
    ?>

    <p><strong>Participants actuels :</strong> <?php echo e($totalInscrits); ?></p>
    <p><strong>Places maximum :</strong> <?php echo e($event->max_participants); ?></p>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($event->max_participants): ?>
        <p><strong>Places restantes :</strong> <?php echo e($event->max_participants - $totalInscrits); ?></p>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>

<div class="mt-12 bg-gray-50 p-8 rounded-2xl border border-gray-200">
    <h3 class="text-2xl font-bold mb-6">S'inscrire à cet événement</h3>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->has('event_full')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <?php echo e($errors->first('event_full')); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-xl flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <form action="<?php echo e(route('events.register', $event->slug)); ?>" method="POST" class="space-y-4">
        <?php echo csrf_field(); ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nom complet</label>
                <input type="text" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <textarea name="allergies" placeholder="Allergies spécifiques" class="border p-2 col-span-2"></textarea>
        </div>
<?php
    // Force la valeur à 0 si elle est absente ou nulle
    $maxAllowed = $event->max_guests_per_registration ?? 0;
?>

<div class="mb-4">
    <label class="block text-sm font-bold mb-2">
        Nombre d'accompagnateurs (Max <?php echo e($maxAllowed); ?>)
    </label>
    <select name="additional_guests" id="guests_count" class="w-full p-2 border rounded">
        <option value="0">Aucun</option>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($maxAllowed > 0): ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 1; $i <= $maxAllowed; $i++): ?>
                <option value="<?php echo e($i); ?>"><?php echo e($i); ?> accompagnateur<?php echo e($i > 1 ? 's' : ''); ?></option>
            <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </select>
</div>
</div>

<div id="guests_fields">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 0; $i < $event->max_guests_per_registration; $i++): ?>
        <div id="guest_form_<?php echo e($i); ?>" class="guest-form p-4 mb-4 border rounded shadow-sm bg-gray-50" style="display: none;">
            <h4 class="font-bold mb-2 text-indigo-600">Accompagnateur n°<?php echo e($i + 1); ?></h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="guests[<?php echo e($i); ?>][firstname]" placeholder="Prénom" class="border p-2 rounded">
                <input type="text" name="guests[<?php echo e($i); ?>][lastname]" placeholder="Nom" class="border p-2 rounded">
                <input type="email" name="guests[<?php echo e($i); ?>][email]" placeholder="Email (optionnel)" class="border p-2 rounded col-span-full">
                <textarea name="guests[<?php echo e($i); ?>][allergies]" placeholder="Allergies spécifiques" class="border p-2 rounded col-span-full"></textarea>
            </div>
        </div>
    <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>

        <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 rounded-xl hover:bg-indigo-700 transition">
            Confirmer mon inscription
        </button>
    </form>
</div>

<a href="<?php echo e(route('events.index')); ?>">Retour à la liste</a>

<script>
    document.getElementById('guests_count').addEventListener('change', function() {
        const count = parseInt(this.value);

        for (let i = 0; i < <?php echo e($maxAllowed); ?>; i++) {
            const field = document.getElementById('guest_form_' + i);
            if (field) {
                const isVisible = i < count;
                field.style.display = isVisible ? 'block' : 'none';

                // On gère le "required" intelligemment
                const inputs = field.querySelectorAll('input');
                inputs.forEach(input => {
                    if (isVisible) {
                        // On ne rend obligatoire que le prénom et le nom
                        // On ignore le champ email (type="email")
                        if (input.type !== 'email') {
                            input.required = true;
                        }
                    } else {
                        input.required = false;
                    }
                });
            }
        }
    });
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\LaravelS6\FilamentLaravel\resources\views/events/show.blade.php ENDPATH**/ ?>