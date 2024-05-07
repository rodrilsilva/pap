<nav x-data="{ open: false }" class="bg-white border-b border-gray-300">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl md:px-6 lg:px-0">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                @if (Auth::user()->admin == '1')
                <a href="{{ route('dashboard') }}"  class="flex items-center gap-2">
                    <x-application-logo class="block w-auto text-gray-800 fill-current h-9" />
                    <h4 class="text-xl font-medium whitespace-nowrap">Carla Lima</h4>
                </a>
                @endif
                @if (Auth::user()->admin == '0')
                <a href="{{ route('cliente.index') }}"  class="flex items-center gap-2">
                    <x-application-logo class="block w-auto text-gray-800 fill-current h-9" />
                    <h4 class="text-xl font-medium whitespace-nowrap">Carla Lima</h4>
                </a>
                @endif
                <!-- Navigation Links -->
                <div class="hidden space-x-8 lg:-my-px lg:ml-10 lg:flex">
                    @if (Auth::user()->admin == '1')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('agenda.index')" :active="request()->routeIs('agenda.index')">
                            {{ __('Agenda') }}
                        </x-nav-link>
                        <x-nav-link :href="route('clientes.index')" :active="request()->routeIs('clientes.index')">
                            {{ __('Clientes') }}
                        </x-nav-link>
                        <x-nav-link :href="route('definicoes.update')" :active="request()->routeIs('definicoes.update')">
                            {{ __('Definições') }}
                        </x-nav-link>
                    @endif
                    @if (Auth::user()->admin == '0')
                    <x-nav-link :href="route('marcacoes.cliente')" :active="request()->routeIs('marcacoes.cliente')">
                        {{ __('Marcações') }}
                    </x-nav-link>
                    <x-nav-link :href="route('cliente.index')" :active="request()->routeIs('cliente.index')">
                        {{ __('Criar Marcação') }}
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden lg:flex lg:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -me-2 lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if (Auth::user()->admin == '1')
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Estatísticas') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('agenda.index')" :active="request()->routeIs('agenda.index')">
                {{ __('Agenda') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('clientes.index')" :active="request()->routeIs('clientes.index')">
                {{ __('Clientes') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('definicoes.update')" :active="request()->routeIs('definicoes.update')">
                {{ __('Definições') }}
            </x-responsive-nav-link>
            @endif
            @if (Auth::user()->admin == '0')
            <x-responsive-nav-link :href="route('marcacoes.cliente')" :active="request()->routeIs('marcacoes.cliente')">
                {{ __('Marcações') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('cliente.index')" :active="request()->routeIs('cliente.index')">
                {{ __('Criar Marcação') }}
            </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
