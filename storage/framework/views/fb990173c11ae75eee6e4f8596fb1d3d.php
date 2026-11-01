<?php $__env->startSection('title', 'Student Management System'); ?>
<?php $__env->startSection('content'); ?>
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-16">
    
    <div class="grid sm:grid-cols-3 gap-4 animate-fade-in">
        <div class="plum-card p-5"><p class="label">Registered students</p><p class="big mt-3"><?php echo e($studentCount); ?></p><p class="text-xs text-white/60 mt-2">across all programmes</p></div>
        <div class="plum-card p-5"><p class="label">Courses on offer</p><p class="big mt-3"><?php echo e($courseCount); ?></p><p class="text-xs text-white/60 mt-2">each with an assigned lecturer</p></div>
        <div class="plum-card p-5"><p class="label">Course registrations</p><p class="big mt-3"><?php echo e($registrationCount); ?></p><p class="text-xs text-white/60 mt-2">no duplicates, guaranteed</p></div>
    </div>

    <div class="grid lg:grid-cols-2 gap-10 items-center mt-14">
        <div>
            <h1 class="font-display text-5xl sm:text-6xl text-plum-800 leading-[1.05]">
                Your courses. <span class="accent">Registered.</span><br>Guaranteed.
            </h1>
            <p class="mt-5 text-[#6d6070] max-w-lg leading-relaxed">
                One place for administrators to manage records, lecturers to see who is in their classes, and students to pick courses and track their own registrations.
            </p>
            <div class="flex flex-wrap gap-3 mt-8">
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-primary glow-teal">Open my dashboard <i data-lucide="arrow-right" class="w-4 h-4"></i></a>
                <?php else: ?>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-primary glow-teal">Create student account <i data-lucide="arrow-right" class="w-4 h-4"></i></a>
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-ghost">I already have an account</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="card p-6">
            <p class="eyebrow">How it works</p>
            <ol class="mt-4 space-y-4">
                <?php $__currentLoopData = [['user-plus', 'Create an account or sign in', 'Students self-register; staff accounts are created by an administrator.'], ['book-open', 'Browse available courses', 'See code, credit units, lecturer and seats left.'], ['check-circle-2', 'Register in one click', 'The system blocks duplicate and over-capacity registrations.']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$icon, $t, $d]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="flex gap-4">
                        <div class="w-10 h-10 rounded-xl bg-[#e3f4f1] flex items-center justify-center shrink-0"><i data-lucide="<?php echo e($icon); ?>" class="w-5 h-5 text-brand-dark"></i></div>
                        <div><p class="font-semibold text-plum-800 text-sm"><?php echo e($t); ?></p><p class="text-sm text-[#7a6d7d]"><?php echo e($d); ?></p></div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ol>
        </div>
    </div>
</section>

<div class="strip">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex flex-wrap items-center justify-between gap-2 text-sm">
        <p class="text-white/80">Registration is open for the new semester.</p>
        <a href="<?php echo e(route('register')); ?>" class="btn btn-primary btn-sm">Register now</a>
    </div>
</div>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <p class="eyebrow">Built-in safeguards</p>
    <h2 class="font-display text-4xl sm:text-5xl text-plum-800 mt-2">Four guarantees.<br><span class="accent">Zero exceptions.</span></h2>
    <div class="card mt-8 divide-y divide-[#f0e8da]">
        <?php $__currentLoopData = [
            ['Role-based access', 'Administrator, Lecturer and Student each see only what they need.', 'Permissions'],
            ['No duplicate registrations', 'A unique key in the database stops a student joining a course twice.', 'Database'],
            ['Private records', 'Students see only their own registrations; lecturers only their own courses.', 'Authorization'],
            ['Capacity checks', 'Courses close automatically when every seat is taken.', 'Validation'],
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$t, $d, $tag]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6 px-5 py-4">
                <p class="font-semibold text-plum-800 sm:w-64"><?php echo e($t); ?> <span class="badge ml-2"><?php echo e($tag); ?></span></p>
                <p class="text-sm text-[#7a6d7d]"><?php echo e($d); ?></p>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="plum-card p-8 sm:p-12 grid md:grid-cols-2 gap-8 items-center">
        <div>
            <p class="eyebrow !text-[#5fd3c6]">Ready when you are</p>
            <h2 class="font-display text-4xl sm:text-5xl mt-2">Your semester, <span class="accent">right now.</span></h2>
            <p class="text-white/70 mt-3 text-sm max-w-md">Sign in with a demo account from the README, or create a student account and register for your courses in under a minute.</p>
        </div>
        <div class="flex md:justify-end gap-3">
            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary">Sign in</a>
            <a href="<?php echo e(route('contact')); ?>" class="btn" style="background:rgba(255,255,255,.1);color:#fff">Contact us</a>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\WADE GADGETS\Desktop\student-management\resources\views/index.blade.php ENDPATH**/ ?>