<?php $__env->startSection('title', 'Create account'); ?>
<?php $__env->startSection('content'); ?>
<section class="max-w-xl mx-auto px-4 py-12">
    <div class="text-center mb-6">
        <p class="eyebrow mb-2">Students</p>
        <h1 class="font-display text-5xl text-plum-800">Create your <span class="accent">account</span></h1>
    </div>
    <form method="POST" action="<?php echo e(route('register')); ?>" class="card p-6 sm:p-8 grid sm:grid-cols-2 gap-5">
        <?php echo csrf_field(); ?>
        <div class="sm:col-span-2">
            <label class="label" for="name">Full name</label>
            <input class="field" id="name" name="name" value="<?php echo e(old('name')); ?>" required>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="field-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div>
            <label class="label" for="email">Email</label>
            <input class="field" type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="field-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div>
            <label class="label" for="student_number">Student number</label>
            <input class="field" id="student_number" name="student_number" value="<?php echo e(old('student_number')); ?>" required>
            <?php $__errorArgs = ['student_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="field-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div>
            <label class="label" for="programme">Programme</label>
            <input class="field" id="programme" name="programme" value="<?php echo e(old('programme')); ?>" required>
            <?php $__errorArgs = ['programme'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="field-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div>
            <label class="label" for="year_of_study">Year of study</label>
            <select class="field" id="year_of_study" name="year_of_study">
                <?php for($y = 1; $y <= 5; $y++): ?><option value="<?php echo e($y); ?>" <?php if(old('year_of_study', 1) == $y): echo 'selected'; endif; ?>>Year <?php echo e($y); ?></option><?php endfor; ?>
            </select>
        </div>
        <div>
            <label class="label" for="password">Password</label>
            <input class="field" type="password" id="password" name="password" required>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="field-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div>
            <label class="label" for="password_confirmation">Confirm password</label>
            <input class="field" type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button class="btn btn-primary sm:col-span-2">Create account</button>
        <p class="text-sm text-center text-[#7a6d7d] sm:col-span-2">Already registered? <a href="<?php echo e(route('login')); ?>" class="font-semibold text-brand-dark">Sign in</a></p>
    </form>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\WADE GADGETS\Desktop\student-management\resources\views/auth/register.blade.php ENDPATH**/ ?>