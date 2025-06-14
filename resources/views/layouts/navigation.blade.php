<nav x-data="{ open: false }" class="border-gray-100 h-24 relative" style="background-color: #091540;">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
        <div class="flex items-center justify-between h-full">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}">
                    <x-application-logo class="block h-12 w-auto fill-current text-white" />
                </a>
            </div>

            <!-- Center section (for non-authenticated users) - Hidden on mobile -->
            @guest
                <div class="hidden md:flex items-center space-x-8">
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')" class="text-white hover:text-[#7692FF]"  style="font-size: 1em;">
                        {{ __('Iniciar sesión') }}
                    </x-nav-link>
                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')" class="text-white hover:text-[#7692FF]" style="font-size: 1em;">
                        {{ __('Registrarse') }}
                    </x-nav-link>
                </div>
            @endguest

            <!-- Navigation Links for authenticated users - Hidden on mobile -->
            @auth
                <div class="hidden md:flex items-center space-x-8">
                    @if (Auth::user()->role == 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-white hover:text-[#7692FF]" style="font-size: 1em;">
                            {{ __('Panel de Administración') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('user.tickets')" :active="request()->routeIs('user.tickets')" class="text-white hover:text-[#7692FF]" style="font-size: 1em;">
                            {{ __('Mis entradas') }}
                        </x-nav-link>
                    @endif
                    <!-- Settings Dropdown -->
                    <div class="flex items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent leading-4 font-medium rounded-md text-white hover:text-[#7692FF] focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ ucfirst(Auth::user()->name) }}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Perfil') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                        {{ __('Cerrar Sesión') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            @endauth

            <!-- Hamburger Menu Button -->
            <div class="flex items-center md:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-200 hover:bg-opacity-80 focus:outline-none focus:bg-opacity-80 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu - Mobile Only -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden md:hidden bg-white absolute w-full z-50 shadow-lg">
        @guest
            <div class="pt-2 pb-3 space-y-1 px-4">
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')" class="flex justify-start">
                    {{ __('Iniciar sesión') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')" class="flex justify-start">
                    {{ __('Registrarse') }}
                </x-responsive-nav-link>
            </div>
        @endguest

        @auth
            <div class="pt-2 pb-1 border-t border-gray-200">
                <div class="mt-3 space-y-1 px-4">
                    @if (Auth::user()->role == 'admin')
                        <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="flex justify-start">
                            {{ __('Panel de Administración') }} - {{ Auth::user()->name }}
                        </x-responsive-nav-link>
                    @else
                        <x-responsive-nav-link :href="route('user.tickets')" :active="request()->routeIs('user.tickets')" class="flex justify-start">
                            {{ __('My Tickets') }} - {{ Auth::user()->name }}
                        </x-responsive-nav-link>
                    @endif
                    <x-responsive-nav-link :href="route('profile.edit')" class="flex justify-start">
                        {{ __('Perfil') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                this.closest('form').submit();"
                            class="flex justify-start">
                            {{ __('Cerrar Sesión') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>