<header>
    <nav class="navbar bg-white shadow-md sm:mb-5 relative max-h-[80px] justify-center">
        <div class="md:container flex-1 justify-between pr-2">
            <a href="{{ route('home') }}" class="w-28 flex-initial">
                <img src="{{ asset('logo.png') }}" alt="logo">
            </a>
            <div id="navbar-collapse">
                <button type="button" id="navbar-close"
                        class="md:hidden text-3xl absolute right-1 top-2 text-gray-500 hover:text-black active:text-primary">
                    <i class="bi bi-x"></i>
                </button>
                <a href="{{ route('home') }}"
                    @class(['active pointer-events-none' => request()->routeIs('home'), 'px-5 py-4 mt-12 md:mt-0 text-lg font-semibold'])>Home</a>
                @auth
                    <a href="{{ route('dashboard') }}"
                        @class(['active pointer-events-none' => request()->routeIs('dashboard'), 'px-5 py-4 text-lg font-semibold'])>Dashboard</a>
                @endauth
                <a href="{{ route('posts.index') }}"
                    @class(['active pointer-events-none' => request()->routeIs('posts.index'), 'px-5 py-4 text-lg font-semibold md:mr-auto'])>Posts</a>
                @auth
                    <a href="{{ route('user.posts', auth()->user()) }}"
                        @class(['active pointer-events-none' => request()->url() === route('user.posts', auth()->user()), 'px-5 py-4 text-lg font-semibold capitalize'])>
                        {{ auth()->user()->name }}
                    </a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-5 py-4 md:pr-0 w-full text-lg font-semibold text-left">Logout
                        </button>
                    </form>
                @endauth
                @guest
                    <a href="{{ route('login.create') }}"
                        @class(['active pointer-events-none' => request()->routeIs('login.create'), 'px-5 py-4 text-lg font-semibold'])>Login</a>
                    <a href="{{ route('register.create') }}"
                        @class(['active pointer-events-none' => request()->routeIs('register.create'), 'px-5 md:pr-0 py-4 text-lg font-semibold'])>Register</a>
                @endguest
            </div>
            <button type="button" class="py-4 md:hidden text-3xl" id="navbar-toggle">
                <i class="bi bi-list"></i>
            </button>
        </div>
    </nav>
</header>
