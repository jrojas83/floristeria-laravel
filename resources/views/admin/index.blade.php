<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Administrador ⚙️') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <p class="text-gray-900 mb-6 text-lg">
                    Bienvenido, <strong>{{ auth()->user()->name }}</strong>
                </p>

                <hr class="my-4">

                <h3 class="font-bold text-lg mb-2">Gestión</h3>
                <ul class="list-disc ml-5 space-y-2 text-blue-600">
                    <li><a href="#" class="hover:underline">Gestionar productos</a></li>
                    <li><a href="#" class="hover:underline">Ver pedidos</a></li>
                    <li><a href="#" class="hover:underline">Clientes</a></li>
                </ul>

                <hr class="my-6">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
                        Cerrar sesión
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>