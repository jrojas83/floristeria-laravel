<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Carrito') }}
        </h2>
    </x-slot>

    @php
        $carrito = $carrito ?? [];
        $totalUnidades = collect($carrito)->sum('cantidad');
        $totalPrecio = collect($carrito)->sum(fn ($item) => ($item['precio'] ?? 0) * ($item['cantidad'] ?? 0));
    @endphp

    <div class="max-w-3xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
        @if (session('success'))
            <div
                class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 dark:border-green-800 dark:bg-green-950/40 dark:text-green-200"
                role="status"
            >
                {{ session('success') }}
            </div>
        @endif

        @if (empty($carrito))
            <div
                class="rounded-2xl border border-dashed border-gray-200 bg-white px-6 py-16 text-center dark:border-gray-700 dark:bg-gray-800/50"
            >
                <p class="text-gray-600 dark:text-gray-300">{{ __('Tu carrito está vacío.') }}</p>
                <a
                    href="{{ route('menu.index') }}"
                    class="mt-4 inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500"
                >
                    {{ __('Ver productos') }}
                </a>
            </div>
        @else
            <ul class="space-y-4" role="list">
                @foreach ($carrito as $id => $item)
                    <li
                        class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800"
                    >
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                            <div>
                                <h3 class="font-semibold text-gray-900 dark:text-white">{{ $item['nombre'] }}</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('Precio unitario') }}:
                                    <span class="tabular-nums font-medium text-gray-800 dark:text-gray-200">
                                        ${{ number_format((float) $item['precio'], 2) }}
                                    </span>
                                </p>
                            </div>
                            <form
                                action="{{ route('carrito.update', $id) }}"
                                method="POST"
                                class="flex flex-wrap items-end gap-2"
                            >
                                @csrf
                                <div>
                                    <label for="cantidad-{{ $id }}" class="sr-only">{{ __('Cantidad') }}</label>
                                    <input
                                        id="cantidad-{{ $id }}"
                                        type="number"
                                        name="cantidad"
                                        value="{{ $item['cantidad'] }}"
                                        min="1"
                                        class="w-24 rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-white"
                                    />
                                </div>
                                <button
                                    type="submit"
                                    class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700 dark:focus:ring-offset-gray-800"
                                >
                                    {{ __('Actualizar') }}
                                </button>
                            </form>
                        </div>
                        <form action="{{ route('carrito.remove', $id) }}" method="POST" class="mt-4 border-t border-gray-100 pt-4 dark:border-gray-700">
                            @csrf
                            <button
                                type="submit"
                                class="text-sm font-medium text-red-600 hover:text-red-500 dark:text-red-400"
                            >
                                {{ __('Eliminar del carrito') }}
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>

            <div
                class="mt-8 flex flex-col gap-4 rounded-2xl border border-gray-200 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-900/40 sm:flex-row sm:items-center sm:justify-between"
            >
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ $totalUnidades }} {{ $totalUnidades === 1 ? __('artículo') : __('artículos') }}
                    </p>
                    <p class="text-2xl font-bold tabular-nums text-gray-900 dark:text-white">
                        ${{ number_format((float) $totalPrecio, 2) }}
                    </p>
                </div>
                <div class="flex flex-col gap-2 sm:flex-row">
                    <form action="{{ route('carrito.clear') }}" method="POST" onsubmit="return confirm('{{ __('¿Vaciar el carrito?') }}');">
                        @csrf
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700"
                        >
                            {{ __('Vaciar carrito') }}
                        </button>
                    </form>
                    <a
                        href="{{ route('menu.index') }}"
                        class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500"
                    >
                        {{ __('Seguir comprando') }}
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
