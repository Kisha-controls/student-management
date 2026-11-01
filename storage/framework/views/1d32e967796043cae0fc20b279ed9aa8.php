<div class="grid sm:grid-cols-2 gap-5">
    <div class="sm:col-span-2">
        <label class="label" for="name">Full name</label>
        <input class="field" id="name" name="name" value="<?php echo e(old('name', $student->name ?? '')); ?>" required>
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
        <input class="field" type="email" id="email" name="email" value="<?php echo e(old('email', $student->email ?? '')); ?>" required>
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
        <input class="field" id="student_number" name="student_number" value="<?php echo e(old('student_number', $student->student_number ?? '')); ?>" required>
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
        <label class="label" for="phone">Phone (optional)</label>
        <input class="field" id="phone" name="phone" value="<?php echo e(old('phone', $student->phone ?? '')); ?>">
        <?php $__errorArgs = ['phone'];
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
        <input class="field" id="programme" name="programme" value="<?php echo e(old('programme', $student->programme ?? '')); ?>" required>
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
            <?php for($y = 1; $y <= 5; $y++): ?><option value="<?php echo e($y); ?>" <?php if(old('year_of_study', $student->year_of_study ?? 1) == $y): echo 'selected'; endif; ?>>Year <?php echo e($y); ?></option><?php endfor; ?>
        </select>
    </div>
</div>
<?php /**PATH C:\Users\WADE GADGETS\Desktop\student-management\resources\views/students/_form.blade.php ENDPATH**/ ?>