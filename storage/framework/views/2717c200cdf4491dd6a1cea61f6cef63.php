<?php $__env->startSection('title', 'Contact us'); ?>
<?php $__env->startSection('content'); ?>
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid lg:grid-cols-2 gap-10 items-start">
        <div>
            <p class="eyebrow mb-2">Contact us</p>
            <h1 class="font-display text-5xl text-plum-800 leading-tight">Questions about <span class="accent">registration?</span></h1>
            <p class="text-[#6d6070] mt-4 mb-8 max-w-md">Send a message to the registry office and we will get back to you within two working days.</p>
            <div class="space-y-3 max-w-md">
                <div class="card p-4 flex gap-3 items-center"><i data-lucide="mail" class="w-5 h-5 text-brand-dark"></i><span class="text-sm">registry@sms.test</span></div>
                <div class="card p-4 flex gap-3 items-center"><i data-lucide="clock" class="w-5 h-5 text-brand-dark"></i><span class="text-sm">Monday–Friday, 8:00am – 5:00pm</span></div>
            </div>
        </div>

        <form method="POST" action="<?php echo e(route('contact.store')); ?>" class="card p-6 sm:p-8 space-y-5">
            <?php echo csrf_field(); ?>
            <div>
                <label class="label" for="full_name">Full name</label>
                <input class="field" id="full_name" name="full_name" value="<?php echo e(old('full_name')); ?>" required>
                <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="field-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="label" for="campus_email">Email</label>
                <input class="field" type="email" id="campus_email" name="campus_email" value="<?php echo e(old('campus_email')); ?>" required>
                <?php $__errorArgs = ['campus_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="field-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="label" for="department">Department</label>
                <input class="field" id="department" name="department" value="<?php echo e(old('department')); ?>" required>
                <?php $__errorArgs = ['department'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="field-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="label" for="message">Message</label>
                <textarea class="field" id="message" name="message" rows="4" required><?php echo e(old('message')); ?></textarea>
                <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="field-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <button class="btn btn-primary w-full">Send message</button>
        </form>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\WADE GADGETS\Desktop\student-management\resources\views/contact.blade.php ENDPATH**/ ?>