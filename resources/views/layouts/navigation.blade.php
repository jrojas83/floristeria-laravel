<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- IZQUIERDA -->
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('menu.index') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('menu.index')" :active="request()->routeIs('menu.index')">
                        Inicio
                    </x-nav-link>
                    <x-nav-link :href="route('carrito.index')" :active="request()->routeIs('carrito.index')">
                        Carrito
                    </x-nav-link>
                    @auth
                        @if (Auth::user()->hasRole('cliente'))
                            <x-nav-link :href="route('cliente.index')" :active="request()->routeIs('cliente.index')">
                                Mi cuenta
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- DERECHA -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm text-gray-500 bg-white dark:bg-gray-800">
                            
                            @auth
                                <div>{{ Auth::user()->name }}</div>
                            @endauth

                            @guest
                                <div>inicio</div>
                            @endguest

                            <div class="ms-1">
                                ▼
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        @auth
                            @if (Auth::user()->hasRole('cliente'))
                                <x-dropdown-link :href="route('cliente.index')">
                                    Mi espacio
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('pedidos.index')">
                                    Mis pedidos
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('direcciones.index')">
                                    Mis direcciones
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('carrito.index')">
                                    Carrito
                                </x-dropdown-link>
                            @endif

                            <x-dropdown-link :href="route('profile.edit')">
                                Perfil
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Cerrar sesión
                                </x-dropdown-link>
                            </form>
                        @endauth

                        @guest
                            <x-dropdown-link :href="route('login')">
                                Iniciar sesión
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('register')">
                                Registrarse
                            </x-dropdown-link>
                        @endguest

                    </x-slot>

                </x-dropdown>
            </div>

        </div>
    </div>
</nav>