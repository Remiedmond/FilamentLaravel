<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Événements</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 antialiased">
    <nav class="bg-white shadow-sm mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="<?php echo e(route('events.index')); ?>" class="text-xl font-bold text-indigo-600">EventApp</a>
            <div class="flex items-center space-x-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->isAdmin()): ?> 
                        <a href="/admin" class="text-indigo-600 font-bold px-3 py-2 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition">
                            Administration
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="text-gray-500 hover:text-red-600 text-sm">Déconnexion</button>
                    </form>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="text-gray-500 hover:text-gray-700 text-sm">Connexion</a>
                    <a href="<?php echo e(route('register')); ?>" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-bold">S'inscrire</a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </nav>
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="mt-12 py-8 bg-white border-t border-gray-200 text-center text-gray-500 text-sm">
        &copy; <?php echo e(date('Y')); ?> EventApp - Tous droits réservés.
    </footer>
</body>
</html>
<?php /**PATH F:\LaravelS6\FilamentLaravel\resources\views/layouts/app.blade.php ENDPATH**/ ?>