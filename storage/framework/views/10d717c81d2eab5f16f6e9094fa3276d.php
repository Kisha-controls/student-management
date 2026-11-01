<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Student Management System'); ?></title>
    <link rel="icon" type="image/svg+xml" href="<?php echo e(asset('assets/img/logo.svg')); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: {
                colors: {
                    plum: { 700: '#4d2459', 800: '#3b1a45', 900: '#2d1233', 950: '#24102a' },
                    brand: { DEFAULT: '#1f9d8f', dark: '#17786d' },
                    cream: '#f6f0e6',
                },
                fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] },
            } }
        };
    </script>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/styles.css')); ?>">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="font-sans antialiased min-h-screen flex flex-col">
    
    <?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main class="flex-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
            <?php echo $__env->make('partials.flash', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <script>lucide.createIcons();</script>
</body>
</html>
<?php /**PATH C:\Users\WADE GADGETS\Desktop\student-management\resources\views/layouts/main.blade.php ENDPATH**/ ?>