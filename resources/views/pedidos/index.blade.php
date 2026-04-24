<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Mis pedidos') }}
        </h2>
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

        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ __('Consulta el estado y el detalle de cada compra.') }}
            </p>
            <a
                href="{{ route('menu.index') }}"
                class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500"
            >
                {{ __('Seguir comprando') }}
            </a>
        </div>

        @if ($pedidos->isEmpty())
            <div
                class="rounded-2xl border border-dashed border-gray-200 bg-white px-6 py-16 text-center dark:border-gray-700 dark:bg-gray-800/50"
            >
                <p class="text-gray-600 dark:text-gray-300">{{ __('Aún no tienes pedidos.') }}</p>
                <a
                    href="{{ route('menu.index') }}"
                    class="mt-4 inline-block text-sm font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400"
                >
                    {{ __('Ir al catálogo') }} →
                </a>
            </div>
        @else
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <ul class="divide-y divide-gray-100 dark:divide-gray-700" role="list">
                    @foreach ($pedidos as $pedido)
                        <li>
                            <a
                                href="{{ route('pedidos.show', $pedido) }}"
                                class="flex flex-col gap-3 p-4 transition hover:bg-gray-50 sm:flex-row sm:items-center sm:justify-between dark:hover:bg-gray-700/50"
                            >
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-900 dark:text-white">
                                        {{ __('Pedido') }} #{{ $pedido->id }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ ($pedido->fecha_pedido ?? $pedido->created_at)->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                                <div class="flex flex-wrap items-center gap-3 sm:justify-end">
                                    @if ($pedido->estado)
                                        <span
                                            class="inline-flex rounded-full bg-indigo-100 px-3 py-1 text-xs font-semibold text-indigo-800 dark:bg-indigo-900/60 dark:text-indigo-200"
                                        >
                                            {{ $pedido->estado->nombre }}
                                        </span>
                                    @endif
                                    <span class="text-lg font-bold tabular-nums text-gray-900 dark:text-white">
                                        ${{ number_format((float) $pedido->total, 2) }}
                                    </span>
                                    <span class="text-sm font-medium text-indigo-600 dark:text-indigo-400">
                                        {{ __('Ver detalle') }} →
                                    </span>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</x-app-layout>
