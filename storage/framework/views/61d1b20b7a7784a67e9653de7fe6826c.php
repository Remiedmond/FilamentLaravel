<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-[#FDFDFC] flex items-center justify-center px-6 py-20">
    <div class="max-w-lg w-full">

        
        <div class="flex flex-col items-center gap-4 mb-8 text-center">
            <span class="px-3 py-1 bg-[#87a391]/10 text-[#87a391] rounded-full text-xs font-bold uppercase tracking-widest">Feedback</span>
            <h1 class="text-4xl md:text-5xl font-black text-[#1b1b18] leading-tight uppercase tracking-tighter">
                Votre avis nous intéresse !
            </h1>
            <p class="text-[#706f6c] text-sm">
                Qu'avez-vous pensé de l'événement
                <span class="font-black text-[#1b1b18] uppercase tracking-tight"> <?php echo e($event->title); ?></span> ?
            </p>
        </div>

        
        <div class="bg-white p-8 md:p-10 rounded-[2.5rem] border border-[#e3e3e0]/50 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#87a391]/5 rounded-bl-full -z-0"></div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 text-red-800 rounded-r-xl shadow-sm">
                    <p class="font-bold mb-1 text-sm">Oups ! Quelques erreurs sont survenues :</p>
                    <ul class="list-disc list-inside text-xs opacity-90">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <li><?php echo e($error); ?></li>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </ul>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <form action="<?php echo e(route('event.feedback.store', ['event' => $event->slug, 'registration' => $registration->id])); ?>" method="POST" class="space-y-8 relative">
                <?php echo csrf_field(); ?>

                
                <div class="p-6 bg-[#fdfdfc] border border-[#e3e3e0] rounded-[2rem] space-y-6">
                    <label class="block text-[11px] font-bold uppercase tracking-widest text-[#706f6c] text-center">
                        Votre note sur 5
                    </label>
                    <div class="flex justify-between items-center px-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [1, 2, 3, 4, 5]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <label class="group cursor-pointer">
                                <input type="radio" name="rating" value="<?php echo e($i); ?>" class="sr-only peer" required>
                                <div class="w-12 h-12 flex items-center justify-center rounded-full border-2 border-[#e3e3e0] text-sm font-black text-[#706f6c] transition-all duration-200
                                    peer-checked:bg-[#1b1b18] peer-checked:text-white peer-checked:border-[#1b1b18] peer-checked:shadow-lg
                                    group-hover:border-[#87a391] group-hover:text-[#87a391]">
                                    <?php echo e($i); ?>

                                </div>
                            </label>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </div>

                
                <div class="space-y-2">
                    <label class="text-[11px] font-bold uppercase tracking-widest text-[#706f6c] ml-1">
                        Un petit mot ? <span class="text-[#87a391] normal-case font-medium tracking-normal">(optionnel)</span>
                    </label>
                    <textarea name="comment" id="comment" rows="4"
                        class="w-full px-5 py-4 bg-[#fdfdfc] border border-[#e3e3e0] rounded-2xl focus:ring-2 focus:ring-[#87a391] focus:border-transparent outline-none transition-all placeholder-[#c0c0bd] text-sm text-[#1b1b18]"
                        placeholder="Dites-nous ce qui vous a plu ou ce qu'on peut améliorer..."></textarea>
                </div>

                
                <button type="submit"
                    class="w-full bg-[#1b1b18] text-white font-bold uppercase tracking-widest text-xs py-5 rounded-full hover:bg-[#87a391] shadow-xl shadow-black/10 transition-all duration-300 transform hover:scale-[1.02]">
                    Envoyer mon avis
                </button>
            </form>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\LaravelS6\FilamentLaravel\resources\views/feedback/form.blade.php ENDPATH**/ ?>