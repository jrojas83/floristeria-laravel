<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel SuperAdmin 🔥') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <p class="text-gray-900 mb-4">
                    Bienvenido, <strong>{{ auth()->user()->name }}</strong>
                </p>

                <!-- El logout en Laravel debe ser por POST por seguridad -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:underline">
                        Cerrar sesión
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>