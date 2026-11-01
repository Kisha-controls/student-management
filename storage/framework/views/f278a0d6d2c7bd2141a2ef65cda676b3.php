<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('content'); ?>
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['eyebrow' => ucfirst($role).' dashboard','title' => 'Hello,','accent' => auth()->user()->name]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['eyebrow' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(ucfirst($role).' dashboard'),'title' => 'Hello,','accent' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(auth()->user()->name)]); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('register courses')): ?> <a href="<?php echo e(route('courses.index')); ?>" class="btn btn-primary">Browse courses</a> <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create students')): ?> <a href="<?php echo e(route('students.create')); ?>" class="btn btn-primary">Add student</a> <?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $attributes = $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e)): ?>
<?php $component = $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e; ?>
<?php unset($__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e); ?>
<?php endif; ?>

    <div class="grid sm:grid-cols-2 lg:grid-cols-<?php echo e(min(count($stats), 4)); ?> gap-4 mb-10">
        <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="plum-card p-5"><p class="label"><?php echo e($label); ?></p><p class="big mt-3"><?php echo e($value); ?></p></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php if($role === 'admin'): ?>
        <div class="card overflow-hidden">
            <div class="px-5 py-4 border-b border-[#f0e8da]"><h2 class="font-display text-2xl text-plum-800">Latest registrations</h2></div>
            <table class="table">
                <thead><tr><th>Student</th><th>Course</th><th>Date</th></tr></thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $latest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr><td><?php echo e($r->student->name); ?></td><td><?php echo e($r->course->code); ?> — <?php echo e($r->course->title); ?></td><td><?php echo e($r->registered_at?->format('d M Y')); ?></td></tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="3" class="text-center text-[#7a6d7d] py-8">No registrations yet.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php elseif($role === 'lecturer'): ?>
        <h2 class="font-display text-3xl text-plum-800 mb-4">My assigned courses</h2>
        <div class="grid md:grid-cols-2 gap-4">
            <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e(route('courses.show', $c)); ?>" class="card p-5 hover:border-brand transition">
                    <span class="badge"><?php echo e($c->code); ?></span>
                    <p class="font-semibold text-plum-800 mt-2"><?php echo e($c->title); ?></p>
                    <p class="text-sm text-[#7a6d7d] mt-1"><?php echo e($c->students_count); ?> registered <?php echo e(Str::plural('student', $c->students_count)); ?></p>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-[#7a6d7d]">No courses have been assigned to you yet.</p>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <h2 class="font-display text-3xl text-plum-800 mb-4">My registered courses</h2>
        <div class="grid md:grid-cols-2 gap-4">
            <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="card p-5">
                    <span class="badge"><?php echo e($c->code); ?></span> <span class="badge badge-plum"><?php echo e($c->credit_units); ?> CU</span>
                    <p class="font-semibold text-plum-800 mt-2"><?php echo e($c->title); ?></p>
                    <p class="text-sm text-[#7a6d7d] mt-1">Lecturer: <?php echo e($c->lecturer?->name ?? 'To be assigned'); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-[#7a6d7d]">You have not registered for any course yet. <a class="font-semibold text-brand-dark" href="<?php echo e(route('courses.index')); ?>">Browse courses</a>.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\WADE GADGETS\Desktop\student-management\resources\views/dashboard.blade.php ENDPATH**/ ?>