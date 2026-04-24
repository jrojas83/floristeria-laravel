<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ $producto->nombre }}
            </h2>
            <a
                href="{{ route('menu.index') }}"
                class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400"
            >
                ← {{ __('Volver al catálogo') }}
            </a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <div
            class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800"
        >
            <div class="p-6 sm:p-8">
                @if ($producto->descripcion)
                    <p class="text-gray-600 dark:text-gray-300">
                        {{ $producto->descripcion }}
                    </p>
                @endif

                <p class="mt-6 text-3xl font-bold tabular-nums text-gray-900 dark:text-white">
                    ${{ number_format((float) $producto->precio, 2) }}
                </p>

                <form action="{{ route('carrito.add', $producto->id) }}" method="POST" class="mt-8">
                    @csrf
                    <x-primary-button class="normal-case tracking-normal">
                        {{ __('Agregar al carrito') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
