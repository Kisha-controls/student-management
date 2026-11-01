
<?php if(session('success')): ?>
    <div class="mb-4 flex items-start gap-3 rounded-xl border border-[#b9e3dd] bg-[#e8f6f3] px-4 py-3 text-sm text-[#17786d] animate-fade-in">
        <i data-lucide="check-circle-2" class="w-5 h-5 shrink-0"></i><span><?php echo e(session('success')); ?></span>
    </div>
<?php endif; ?>
<?php if(session('error')): ?>
    <div class="mb-4 flex items-start gap-3 rounded-xl border border-[#f0c9cf] bg-[#fdeef0] px-4 py-3 text-sm text-[#b4233a] animate-fade-in">
        <i data-lucide="alert-circle" class="w-5 h-5 shrink-0"></i><span><?php echo e(session('error')); ?></span>
    </div>
<?php endif; ?>
<?php if($errors->any() && ! request()->routeIs('login', 'register')): ?>
    <div class="mb-4 rounded-xl border border-[#f0c9cf] bg-[#fdeef0] px-4 py-3 text-sm text-[#b4233a]">
        <p class="font-semibold mb-1">Please fix the following:</p>
        <ul class="list-disc pl-5 space-y-0.5"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
    </div>
<?php endif; ?>
<?php /**PATH C:\Users\WADE GADGETS\Desktop\student-management\resources\views/partials/flash.blade.php ENDPATH**/ ?>