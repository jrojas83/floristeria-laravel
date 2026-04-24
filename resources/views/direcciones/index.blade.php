<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Mis direcciones') }}
            </h2>
            <a
                href="{{ route('direcciones.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500"
            >
                {{ __('Añadir dirección') }}
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
        @if (session('success'))
            <div
                class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 dark:border-green-800 dark:bg-green-950/40 dark:text-green-200"
                role="status"
            >
                {{ session('success') }}
            </div>
        @endif

        @if ($direcciones->isEmpty())
            <div
                class="rounded-2xl border border-dashed border-gray-200 bg-white px-6 py-16 text-center dark:border-gray-700 dark:bg-gray-800/50"
            >
                <p class="text-gray-600 dark:text-gray-300">
                    {{ __('No has guardado ninguna dirección todavía.') }}
                </p>
                <a
                    href="{{ route('direcciones.create') }}"
                    class="mt-4 inline-block text-sm font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400"
                >
                    {{ __('Crear la primera') }} →
                </a>
            </div>
        @else
            <ul class="grid gap-4 sm:grid-cols-2" role="list">
                @foreach ($direcciones as $direccion)
                    <li
                        class="flex flex-col rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800"
                    >
                        <p class="flex-1 whitespace-pre-line text-sm text-gray-800 dark:text-gray-100">
                            {{ $direccion->direccion }}
                        </p>
                        @if ($direccion->ciudad)
                            <p class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-300">
                                {{ $direccion->ciudad }}
                            </p>
                        @endif
                        @if ($direccion->referencia)
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                {{ __('Ref.') }}: {{ $direccion->referencia }}
                            </p>
                        @endif
                        <div class="mt-4 flex flex-wrap gap-2 border-t border-gray-100 pt-4 dark:border-gray-700">
                            <a
                                href="{{ route('direcciones.edit', $direccion) }}"
                                class="inline-flex flex-1 items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-xs font-semibold text-gray-700 transition hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 sm:flex-none"
                            >
                                {{ __('Editar') }}
                            </a>
                            <form
                                action="{{ route('direcciones.destroy', $direccion) }}"
                                method="POST"
                                class="inline flex-1 sm:flex-none"
                                onsubmit="return confirm('{{ __('¿Eliminar esta dirección?') }}');"
                            >
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="w-full rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-100 dark:border-red-900 dark:bg-red-950/40 dark:text-red-300 dark:hover:bg-red-950/60"
                                >
                                    {{ __('Eliminar') }}
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif

        <p class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
            <a href="{{ route('menu.index') }}" class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400">
                ← {{ __('Volver a la tienda') }}
            </a>
        </p>
    </div>
</x-app-layout>
