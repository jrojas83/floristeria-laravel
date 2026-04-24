<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Pedido') }} #{{ $pedido->id }}
            </h2>
            <a
                href="{{ route('pedidos.index') }}"
                class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400"
            >
                ← {{ __('Volver a mis pedidos') }}
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

        <div class="grid gap-6 lg:grid-cols-3">
            <div class="space-y-6 lg:col-span-2">
                <div
                    class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800"
                >
                    <div class="border-b border-gray-100 px-4 py-3 dark:border-gray-700">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ __('Productos') }}
                        </h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-900/50">
                                <tr>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400"
                                    >
                                        {{ __('Producto') }}
                                    </th>
                                    <th
                                        class="px-4 py-3 text-right text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400"
                                    >
                                        {{ __('Cant.') }}
                                    </th>
                                    <th
                                        class="px-4 py-3 text-right text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400"
                                    >
                                        {{ __('P. unit.') }}
                                    </th>
                                    <th
                                        class="px-4 py-3 text-right text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400"
                                    >
                                        {{ __('Subtotal') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach ($pedido->detalles as $detalle)
                                    <tr>
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                            {{ $detalle->producto->nombre ?? __('Producto') }}
                                        </td>
                                        <td class="px-4 py-3 text-right tabular-nums text-gray-600 dark:text-gray-300">
                                            {{ $detalle->cantidad }}
                                        </td>
                                        <td class="px-4 py-3 text-right tabular-nums text-gray-600 dark:text-gray-300">
                                            ${{ number_format((float) $detalle->precio_unitario, 2) }}
                                        </td>
                                        <td class="px-4 py-3 text-right font-semibold tabular-nums text-gray-900 dark:text-white">
                                            ${{ number_format((float) $detalle->subtotal, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="flex justify-end border-t border-gray-100 bg-gray-50 px-4 py-3 dark:border-gray-700 dark:bg-gray-900/30"
                    >
                        <div class="text-right">
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('Total') }}</p>
                            <p class="text-xl font-bold tabular-nums text-gray-900 dark:text-white">
                                ${{ number_format((float) $pedido->total, 2) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800"
                >
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                        {{ __('Estado') }}
                    </h3>
                    @if ($pedido->estado)
                        <p
                            class="mt-2 inline-flex rounded-full bg-indigo-100 px-3 py-1 text-sm font-semibold text-indigo-800 dark:bg-indigo-900/60 dark:text-indigo-200"
                        >
                            {{ $pedido->estado->nombre }}
                        </p>
                    @endif
                    <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                        {{ __('Fecha') }}:
                        {{ ($pedido->fecha_pedido ?? $pedido->created_at)->format('d/m/Y H:i') }}
                    </p>
                </div>

                <div
                    class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800"
                >
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                        {{ __('Entrega') }}
                    </h3>
                    <p class="mt-2 whitespace-pre-line text-sm text-gray-600 dark:text-gray-300">
                        {{ $pedido->direccion_texto ?: __('Sin dirección registrada.') }}
                    </p>
                </div>

                <a
                    href="{{ route('menu.index') }}"
                    class="flex w-full items-center justify-center rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500"
                >
                    {{ __('Seguir comprando') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
