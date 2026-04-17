<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bienvenido Cliente 🛍️') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                
                <p class="mb-6 text-lg">
                    Hola, <strong>{{ auth()->user()->name }}</strong>
                </p>

                <hr class="my-4">

                <h3 class="font-bold text-lg mb-3">Opciones</h3>
                <ul class="list-disc ml-5 space-y-3">
                    <li>
                        <a href="{{ route('menu.index') }}" class="text-indigo-600 hover:text-indigo-900 hover:underline">
                            Ver productos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pedidos.index') }}" class="text-indigo-600 hover:text-indigo-900 hover:underline">
                            Mis pedidos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.edit') }}" class="text-indigo-600 hover:text-indigo-900 hover:underline">
                            Mi perfil
                        </a>
                    </li>
                </ul>

                <hr class="my-6">

                <!-- Botón de Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-150">
                        Cerrar sesión
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>