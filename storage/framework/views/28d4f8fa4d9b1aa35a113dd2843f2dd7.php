<header class="sticky top-0 z-50 bg-cream/90 backdrop-blur border-b border-[#e4dacb]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="<?php echo e(auth()->check() ? route('dashboard') : route('index')); ?>" class="flex items-center gap-3">
                <img src="<?php echo e(asset('assets/img/logo.svg')); ?>" alt="SMS" class="h-9 w-9">
                <span class="font-display text-xl text-plum-800">Student<span class="accent"> Portal</span></span>
            </a>

            
            <nav class="hidden md:flex items-center gap-7">
                <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('index')); ?>" class="nav-link <?php echo e(request()->routeIs('index') ? 'active' : ''); ?>">Home</a>
                    <a href="<?php echo e(route('contact')); ?>" class="nav-link <?php echo e(request()->routeIs('contact') ? 'active' : ''); ?>">Contact</a>
                <?php endif; ?>
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">Dashboard</a>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view students')): ?>
                        <a href="<?php echo e(route('students.index')); ?>" class="nav-link <?php echo e(request()->routeIs('students.*') ? 'active' : ''); ?>">Students</a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['view courses', 'view assigned courses'])): ?>
                        <a href="<?php echo e(route('courses.index')); ?>" class="nav-link <?php echo e(request()->routeIs('courses.*') ? 'active' : ''); ?>">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view courses')): ?> Courses <?php else: ?> My courses <?php endif; ?>
                        </a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['view registrations', 'view own registrations'])): ?>
                        <a href="<?php echo e(route('registrations.index')); ?>" class="nav-link <?php echo e(request()->routeIs('registrations.*') ? 'active' : ''); ?>">Registrations</a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage users')): ?>
                        <a href="<?php echo e(route('users.index')); ?>" class="nav-link <?php echo e(request()->routeIs('users.*') ? 'active' : ''); ?>">Users</a>
                    <?php endif; ?>
                <?php endif; ?>
            </nav>

            <div class="hidden md:flex items-center gap-3">
                <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-ghost">Sign in</a>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-primary">Create account</a>
                <?php endif; ?>
                <?php if(auth()->guard()->check()): ?>
                    <div class="text-right leading-tight">
                        <p class="text-sm font-semibold text-plum-800"><?php echo e(auth()->user()->name); ?></p>
                        <p class="text-[11px] text-[#7a6d7d] capitalize"><?php echo e(auth()->user()->roleName()); ?></p>
                    </div>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-ghost btn-sm">Sign out</button>
                    </form>
                <?php endif; ?>
            </div>

            <label for="mobile-nav-toggle" class="md:hidden p-2 text-plum-800 cursor-pointer"><i data-lucide="menu" class="w-6 h-6"></i></label>
        </div>

        <input type="checkbox" id="mobile-nav-toggle" class="peer hidden">
        <div class="hidden peer-checked:block md:!hidden py-4 border-t border-[#e4dacb]">
            <div class="flex flex-col gap-3 text-sm font-medium text-plum-800">
                <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('index')); ?>">Home</a>
                    <a href="<?php echo e(route('contact')); ?>">Contact</a>
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-ghost">Sign in</a>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-primary">Create account</a>
                <?php endif; ?>
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view students')): ?> <a href="<?php echo e(route('students.index')); ?>">Students</a> <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['view courses', 'view assigned courses'])): ?> <a href="<?php echo e(route('courses.index')); ?>">Courses</a> <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['view registrations', 'view own registrations'])): ?> <a href="<?php echo e(route('registrations.index')); ?>">Registrations</a> <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage users')): ?> <a href="<?php echo e(route('users.index')); ?>">Users</a> <?php endif; ?>
                    <form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?><button class="btn btn-ghost w-full">Sign out (<?php echo e(auth()->user()->name); ?>)</button></form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
<?php /**PATH C:\Users\WADE GADGETS\Desktop\student-management\resources\views/layouts/header.blade.php ENDPATH**/ ?>