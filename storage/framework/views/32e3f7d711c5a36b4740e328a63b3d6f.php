<?php $__env->startSection('content'); ?>
<div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-100">
    <h2 class="text-2xl font-bold mb-6 text-center">Inscription</h2>
    <form method="POST" action="<?php echo e(route('register')); ?>">
        <?php echo csrf_field(); ?>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nom</label>
            <input type="text" name="name" class="w-full p-3 border rounded-lg" value="<?php echo e(old('name')); ?>" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" class="w-full p-3 border rounded-lg" value="<?php echo e(old('email')); ?>" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Mot de passe</label>
            <input type="password" name="password" class="w-full p-3 border rounded-lg" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" class="w-full p-3 border rounded-lg" required>
        </div>
        <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition">S'inscrire</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\LaravelS6\FilamentLaravel\resources\views/auth/register.blade.php ENDPATH**/ ?>