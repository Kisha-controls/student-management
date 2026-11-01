<?php $__env->startSection('title', 'Courses'); ?>
<?php $__env->startSection('content'); ?>
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view courses')): ?>
        <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['eyebrow' => 'Catalogue','title' => 'Available','accent' => 'courses']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['eyebrow' => 'Catalogue','title' => 'Available','accent' => 'courses']); ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create courses')): ?><a href="<?php echo e(route('courses.create')); ?>" class="btn btn-primary"><i data-lucide="plus" class="w-4 h-4"></i> Add course</a><?php endif; ?>
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
    <?php else: ?>
        <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['eyebrow' => 'Lecturer','title' => 'My assigned','accent' => 'courses']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['eyebrow' => 'Lecturer','title' => 'My assigned','accent' => 'courses']); ?>
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
    <?php endif; ?>

    <div class="card overflow-x-auto">
        <table class="table">
            <thead><tr><th>Code</th><th>Course</th><th>Lecturer</th><th>CU</th><th>Seats</th><th class="text-right">Actions</th></tr></thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><span class="badge"><?php echo e($c->code); ?></span></td>
                    <td><p class="font-semibold text-plum-800"><?php echo e($c->title); ?></p></td>
                    <td><?php echo e($c->lecturer?->name ?? '—'); ?></td>
                    <td><?php echo e($c->credit_units); ?></td>
                    <td><?php echo e($c->students_count); ?> / <?php echo e($c->capacity); ?></td>
                    <td class="text-right whitespace-nowrap">
                        <a href="<?php echo e(route('courses.show', $c)); ?>" class="btn btn-ghost btn-sm">View</a>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('register courses')): ?>
                            <?php if(in_array($c->id, $registeredIds)): ?>
                                <span class="badge badge-amber">Registered</span>
                            <?php else: ?>
                                <form method="POST" action="<?php echo e(route('registrations.store')); ?>" class="inline">
                                    <?php echo csrf_field(); ?> <input type="hidden" name="course_id" value="<?php echo e($c->id); ?>">
                                    <button class="btn btn-primary btn-sm">Register</button>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit courses')): ?><a href="<?php echo e(route('courses.edit', $c)); ?>" class="btn btn-ghost btn-sm">Edit</a><?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete courses')): ?>
                            <form method="POST" action="<?php echo e(route('courses.destroy', $c)); ?>" class="inline" onsubmit="return confirm('Delete <?php echo e(addslashes($c->code)); ?>?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" class="text-center text-[#7a6d7d] py-10">No courses to show.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="mt-5"><?php echo e($courses->links()); ?></div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\WADE GADGETS\Desktop\student-management\resources\views/courses/index.blade.php ENDPATH**/ ?>