<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['eyebrow' => null, 'title', 'accent' => null]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['eyebrow' => null, 'title', 'accent' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
    <div>
        <?php if($eyebrow): ?><p class="eyebrow mb-2"><?php echo e($eyebrow); ?></p><?php endif; ?>
        <h1 class="font-display text-4xl sm:text-5xl text-plum-800 leading-tight"><?php echo e($title); ?> <?php if($accent): ?><span class="accent"><?php echo e($accent); ?></span><?php endif; ?></h1>
    </div>
    <div class="flex items-center gap-2"><?php echo e($slot); ?></div>
</div>
<?php /**PATH C:\Users\WADE GADGETS\Desktop\student-management\resources\views/components/page-header.blade.php ENDPATH**/ ?>