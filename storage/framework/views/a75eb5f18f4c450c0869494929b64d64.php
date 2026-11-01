<?php $__env->startSection('title', 'Sign in'); ?>
<?php $__env->startSection('content'); ?>
<section class="max-w-md mx-auto px-4 py-12">
    <div class="text-center mb-6">
        <p class="eyebrow mb-2">Welcome back</p>
        <h1 class="font-display text-5xl text-plum-800">Sign <span class="accent">in</span></h1>
    </div>
    <form method="POST" action="<?php echo e(route('login')); ?>" class="card p-6 sm:p-8 space-y-5">
        <?php echo csrf_field(); ?>
        <div>
            <label class="label" for="email">Email</label>
            <input class="field" type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus placeholder="you@example.com">
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
            <label class="label" for="password">Password</label>
            <input class="field" type="password" id="password" name="password" required placeholder="••••••••">
        </div>
        <label class="flex items-center gap-2 text-sm text-[#7a6d7d]"><input type="checkbox" name="remember" class="rounded border-[#d9ccb9] text-brand"> Keep me signed in</label>
        <button class="btn btn-primary w-full">Sign in</button>
        <p class="text-sm text-center text-[#7a6d7d]">New student? <a href="<?php echo e(route('register')); ?>" class="font-semibold text-brand-dark">Create an account</a></p>
    </form>
    <div class="card p-4 mt-5 text-xs text-[#7a6d7d]">
        <p class="font-semibold text-plum-800 mb-1">Demo accounts (password: <code>password</code>)</p>
        <p>admin@sms.test · lecturer1@sms.test · student1@sms.test</p>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\WADE GADGETS\Desktop\student-management\resources\views/auth/login.blade.php ENDPATH**/ ?>