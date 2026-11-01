<footer class="strip mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <img src="<?php echo e(asset('assets/img/logo.svg')); ?>" alt="" class="h-10 w-10">
                    <span class="font-display text-2xl">Student<span class="accent"> Portal</span></span>
                </div>
                <p class="text-sm text-white/70 leading-relaxed max-w-sm">Manage students, courses, lecturers and course registrations in one place. Built with Laravel for Advanced Web Application Development (BUC3131).</p>
            </div>
            <div>
                <h4 class="eyebrow !text-[#5fd3c6] mb-4">Quick links</h4>
                <ul class="space-y-2 text-sm text-white/75">
                    <li><a href="<?php echo e(route('index')); ?>" class="hover:text-white">Home</a></li>
                    <?php if(auth()->guard()->guest()): ?>
                        <li><a href="<?php echo e(route('login')); ?>" class="hover:text-white">Sign in</a></li>
                        <li><a href="<?php echo e(route('register')); ?>" class="hover:text-white">Create student account</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo e(route('dashboard')); ?>" class="hover:text-white">Dashboard</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo e(route('contact')); ?>" class="hover:text-white">Contact us</a></li>
                </ul>
            </div>
            <div>
                <h4 class="eyebrow !text-[#5fd3c6] mb-4">Registry office</h4>
                <ul class="space-y-2 text-sm text-white/75">
                    <li>registry@sms.test</li>
                    <li>Mon–Fri, 8:00am – 5:00pm</li>
                </ul>
            </div>
        </div>
        <div class="pt-8 mt-10 border-t border-white/10 flex flex-col sm:flex-row justify-between gap-3 text-xs text-white/50">
            <p>© <?php echo e(date('Y')); ?> Student Management System.</p>
            <p></p>
        </div>
    </div>
</footer>
<?php /**PATH C:\Users\WADE GADGETS\Desktop\student-management\resources\views/layouts/footer.blade.php ENDPATH**/ ?>