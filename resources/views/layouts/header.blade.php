<header class="sticky top-0 z-50 bg-cream/90 backdrop-blur border-b border-[#e4dacb]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="{{ auth()->check() ? route('dashboard') : route('index') }}" class="flex items-center gap-3">
                <img src="{{ asset('assets/img/logo.svg') }}" alt="SMS" class="h-9 w-9">
                <span class="font-display text-xl text-plum-800">Student<span class="accent"> Portal</span></span>
            </a>

            {{-- Navigation: links are shown according to the user's permissions --}}
            <nav class="hidden md:flex items-center gap-7">
                @guest
                    <a href="{{ route('index') }}" class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                    @can('view students')
                        <a href="{{ route('students.index') }}" class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}">Students</a>
                    @endcan
                    @canany(['view courses', 'view assigned courses'])
                        <a href="{{ route('courses.index') }}" class="nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}">
                            @can('view courses') Courses @else My courses @endcan
                        </a>
                    @endcanany
                    @canany(['view registrations', 'view own registrations'])
                        <a href="{{ route('registrations.index') }}" class="nav-link {{ request()->routeIs('registrations.*') ? 'active' : '' }}">Registrations</a>
                    @endcanany
                    @can('manage users')
                        <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">Users</a>
                    @endcan
                @endauth
            </nav>

            <div class="hidden md:flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-ghost">Sign in</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Create account</a>
                @endguest
                @auth
                    <div class="text-right leading-tight">
                        <p class="text-sm font-semibold text-plum-800">{{ auth()->user()->name }}</p>
                        <p class="text-[11px] text-[#7a6d7d] capitalize">{{ auth()->user()->roleName() }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-ghost btn-sm">Sign out</button>
                    </form>
                @endauth
            </div>

            <label for="mobile-nav-toggle" class="md:hidden p-2 text-plum-800 cursor-pointer"><i data-lucide="menu" class="w-6 h-6"></i></label>
        </div>

        <input type="checkbox" id="mobile-nav-toggle" class="peer hidden">
        <div class="hidden peer-checked:block md:!hidden py-4 border-t border-[#e4dacb]">
            <div class="flex flex-col gap-3 text-sm font-medium text-plum-800">
                @guest
                    <a href="{{ route('index') }}">Home</a>
                    <a href="{{ route('contact') }}">Contact</a>
                    <a href="{{ route('login') }}" class="btn btn-ghost">Sign in</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Create account</a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    @can('view students') <a href="{{ route('students.index') }}">Students</a> @endcan
                    @canany(['view courses', 'view assigned courses']) <a href="{{ route('courses.index') }}">Courses</a> @endcanany
                    @canany(['view registrations', 'view own registrations']) <a href="{{ route('registrations.index') }}">Registrations</a> @endcanany
                    @can('manage users') <a href="{{ route('users.index') }}">Users</a> @endcan
                    <form method="POST" action="{{ route('logout') }}">@csrf<button class="btn btn-ghost w-full">Sign out ({{ auth()->user()->name }})</button></form>
                @endauth
            </div>
        </div>
    </div>
</header>
