<?php $__env->startSection('title', 'Students'); ?>
<?php $__env->startSection('content'); ?>
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <?php if (isset($component)) { $__componentOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf8d4ea307ab1e58d4e472a43c8548d8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-header','data' => ['eyebrow' => 'Records','title' => 'All','accent' => 'students']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['eyebrow' => 'Records','title' => 'All','accent' => 'students']); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create students')): ?><a href="<?php echo e(route('students.create')); ?>" class="btn btn-primary"><i data-lucide="plus" class="w-4 h-4"></i> Add student</a><?php endif; ?>
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

    <form method="GET" class="mb-5 flex gap-2 max-w-md">
        <input class="field" name="q" value="<?php echo e(request('q')); ?>" placeholder="Search name, number or programme">
        <button class="btn btn-plum">Search</button>
    </form>

    <div class="card overflow-x-auto">
        <table class="table">
            <thead><tr><th>Student no.</th><th>Name</th><th>Programme</th><th>Year</th><th>Courses</th><th class="text-right">Actions</th></tr></thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><span class="badge badge-plum"><?php echo e($s->student_number); ?></span></td>
                    <td><p class="font-semibold text-plum-800"><?php echo e($s->name); ?></p><p class="text-xs text-[#7a6d7d]"><?php echo e($s->email); ?></p></td>
                    <td><?php echo e($s->programme); ?></td>
                    <td>Year <?php echo e($s->year_of_study); ?></td>
                    <td><?php echo e($s->courses_count); ?></td>
                    <td class="text-right whitespace-nowrap">
                        <a href="<?php echo e(route('students.show', $s)); ?>" class="btn btn-ghost btn-sm">View</a>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit students')): ?><a href="<?php echo e(route('students.edit', $s)); ?>" class="btn btn-ghost btn-sm">Edit</a><?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete students')): ?>
                            <form method="POST" action="<?php echo e(route('students.destroy', $s)); ?>" class="inline" onsubmit="return confirm('Delete <?php echo e(addslashes($s->name)); ?>?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" class="text-center text-[#7a6d7d] py-10">No students found.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="mt-5"><?php echo e($students->links()); ?></div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\WADE GADGETS\Desktop\student-management\resources\views/students/index.blade.php ENDPATH**/ ?>