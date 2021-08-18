<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a class="text-dark" href="{{ route('dashboard') }}" style="text-decoration: none">
                        <div class="logo-font" style="font-size: 2rem">
                            {{ config('app.name') }}
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" style="text-decoration: none">
                        <span class="material-icons">
                            public
                        </span>
                        &nbsp;
                        <b>
                            Inicio
                        </b>
                    </x-nav-link>
                </div>
                <div class="hidden sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('contenidoPersonalizado')" :active="request()->routeIs('contenidoPersonalizado')" style="text-decoration: none">
                        <span class="material-icons">
                            auto_fix_high
                        </span>
                        &nbsp;
                        <b>
                            Contenido personalizado
                        </b>
                    </x-nav-link>
                </div>
                <div class="hidden sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('mostrarTopicos')" :active="request()->routeIs('mostrarTopicos')" style="text-decoration: none">
                        <span class="material-icons">
                            menu_book
                        </span>
                        &nbsp;
                        <b>
                            Tópicos
                        </b>
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <div class="d-flex justify-content-end">
                            <span class="material-icons">
                                account_circle
                            </span>
                            &nbsp;
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div style="font-size: 1.04rem">
                                    {{ Auth::user()->alias }}
                                </div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </x-slot>

                    <x-slot name="content">
                        <form method="GET" action="{{ route('verUsuario', ['alias' => Auth::user()->alias]) }}">
                            <x-dropdown-link onclick="event.preventDefault(); this.closest('form').submit();">
                                <div class="d-flex justify-content-start">
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons">
                                            person_outline
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        &nbsp;
                                        {{ __('Perfil') }}
                                    </div>
                                </div>
                            </x-dropdown-link>
                        </form>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link onclick="event.preventDefault(); this.closest('form').submit();">
                                <div class="d-flex justify-content-start">
                                    <div class="d-flex align-items-center">
                                        <span class="material-icons">
                                            logout
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        &nbsp;
                                        {{ __('Salir') }}
                                    </div>
                                </div>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <div class="d-flex justify-content-start">
                    <span class="material-icons">
                        public
                    </span>
                    &nbsp;
                    {{ __('Inicio') }}
                </div>
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('contenidoPersonalizado')" :active="request()->routeIs('contenidoPersonalizado')">
                <div class="d-flex justify-content-start">
                    <span class="material-icons">
                        auto_fix_high
                    </span>
                    &nbsp;
                    {{ __('Contenido personalizado') }}
                </div>
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('mostrarTopicos')" :active="request()->routeIs('mostrarTopicos')">
                <div class="d-flex justify-content-start">
                    <span class="material-icons">
                        menu_book
                    </span>
                    &nbsp;
                    {{ __('Tópicos') }}
                </div>

            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">
                        <strong>
                            {{ Auth::user()->alias }}
                        </strong>
                    </div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="GET" action="{{ route('verUsuario', ['alias' => Auth::user()->alias]) }}">
                    @csrf
                    <x-responsive-nav-link
                            :href="route('verUsuario', ['alias' => Auth::user()->alias])"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                    >
                        {{ __('Perfil') }}
                    </x-responsive-nav-link>
                </form>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Salir') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
