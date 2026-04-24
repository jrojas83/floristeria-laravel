<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    @php
        $carrito = session('carrito', []);
        $totalUnidades = collect($carrito)->sum('cantidad');
        $totalPrecio = collect($carrito)->sum(fn ($item) => ($item['precio'] ?? 0) * ($item['cantidad'] ?? 0));
    @endphp

    <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8 lg:py-10">
        @if (session('success'))
            <div
                class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 dark:border-green-800 dark:bg-green-950/40 dark:text-green-200"
                role="status"
            >
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div
                class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800 dark:border-red-900 dark:bg-red-950/40 dark:text-red-200"
                role="alert"
            >
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div
                class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800 dark:border-red-900 dark:bg-red-950/40 dark:text-red-200"
                role="alert"
            >
                <ul class="list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-12 lg:gap-10 xl:gap-12">
            {{-- Catálogo --}}
            <section class="lg:col-span-8" aria-labelledby="catalogo-heading">
                <div class="mb-6 flex flex-col gap-1 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <h2 id="catalogo-heading" class="text-lg font-semibold text-gray-900 dark:text-white">
                            Catálogo
                        </h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Elige productos y añádelos al carrito.
                        </p>
                    </div>
                </div>

                <ul class="grid gap-4 sm:grid-cols-2 xl:grid-cols-2 2xl:grid-cols-3">
                    @foreach ($productos as $producto)
                        <li class="min-w-0">
                            <article
                                class="group flex h-full min-h-[220px] flex-col rounded-2xl border border-gray-200/80 bg-white p-5 shadow-sm ring-1 ring-transparent transition duration-300 ease-out hover:-translate-y-0.5 hover:border-gray-300 hover:shadow-md hover:ring-gray-200/60 dark:border-gray-700 dark:bg-gray-800/80 dark:ring-transparent dark:hover:border-gray-600 dark:hover:ring-gray-600/40"
                            >
                                <div class="flex flex-1 flex-col gap-3">
                                    <div class="space-y-1">
                                        <h3
                                            class="text-base font-semibold leading-snug text-gray-900 transition-colors group-hover:text-indigo-600 dark:text-white dark:group-hover:text-indigo-400"
                                        >
                                            {{ $producto->nombre }}
                                        </h3>
                                        <p class="text-2xl font-bold tabular-nums text-gray-900 dark:text-white">
                                            ${{ number_format((float) $producto->precio, 2) }}
                                        </p>
                                    </div>

                                    <form
                                        action="{{ route('carrito.add', $producto->id) }}"
                                        method="POST"
                                        class="mt-auto pt-1"
                                    >
                                        @csrf
                                        <x-primary-button
                                            class="w-full justify-center normal-case tracking-normal text-sm"
                                        >
                                            {{ __('Agregar al carrito') }}
                                        </x-primary-button>
                                    </form>
                                </div>
                            </article>
                        </li>
                    @endforeach
                </ul>
            </section>

            {{-- Carrito --}}
            <aside class="lg:col-span-4" aria-labelledby="carrito-heading">
                <div
                    class="rounded-2xl border border-gray-200/80 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800/80 lg:sticky lg:top-24 lg:max-h-[calc(100vh-8rem)] lg:flex lg:flex-col"
                >
                    <div class="mb-4 flex shrink-0 items-start justify-between gap-3 border-b border-gray-100 pb-4 dark:border-gray-700">
                        <div>
                            <h2
                                id="carrito-heading"
                                class="text-lg font-semibold text-gray-900 dark:text-white"
                            >
                                Carrito
                            </h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                @if ($totalUnidades > 0)
                                    {{ $totalUnidades }} {{ $totalUnidades === 1 ? 'artículo' : 'artículos' }}
                                @else
                                    Sin artículos aún
                                @endif
                            </p>
                        </div>
                        @if ($totalUnidades > 0)
                            <span
                                class="inline-flex h-8 min-w-[2rem] items-center justify-center rounded-full bg-indigo-100 px-2 text-sm font-semibold text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-200"
                            >
                                {{ $totalUnidades }}
                            </span>
                        @endif
                    </div>

                    <div class="min-h-0 flex-1 space-y-3 overflow-y-auto pr-1 lg:overflow-y-auto">
                        @forelse ($carrito as $id => $item)
                            <div
                                class="flex flex-col gap-3 rounded-xl border border-gray-100 bg-gray-50/80 p-4 transition dark:border-gray-600 dark:bg-gray-900/40 sm:flex-row sm:items-center sm:justify-between"
                            >
                                <div class="min-w-0 flex-1 space-y-1">
                                    <p class="truncate font-medium text-gray-900 dark:text-white">
                                        {{ $item['nombre'] }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Cantidad:
                                        <span class="font-semibold tabular-nums text-gray-800 dark:text-gray-200">
                                            {{ $item['cantidad'] }}
                                        </span>
                                        @if (isset($item['precio']))
                                            <span class="mx-1 text-gray-300 dark:text-gray-600">·</span>
                                            <span class="tabular-nums">
                                                ${{ number_format((float) $item['precio'], 2) }}
                                            </span>
                                        @endif
                                    </p>
                                </div>
                                <form action="{{ route('carrito.remove', $id) }}" method="POST" class="shrink-0">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="w-full rounded-lg border border-transparent bg-white px-3 py-2 text-sm font-medium text-red-600 shadow-sm transition hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-red-950/30 dark:focus:ring-offset-gray-800 sm:w-auto"
                                    >
                                        {{ __('Quitar') }}
                                    </button>
                                </form>
                            </div>
                        @empty
                            <div
                                class="rounded-xl border border-dashed border-gray-200 bg-gray-50/50 px-4 py-10 text-center dark:border-gray-600 dark:bg-gray-900/30"
                            >
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Tu carrito está vacío. Añade productos desde el catálogo.
                                </p>
                            </div>
                        @endforelse
                    </div>

                    @if ($totalUnidades > 0)
                        <div
                            class="mt-4 shrink-0 border-t border-gray-100 pt-4 dark:border-gray-700"
                        >
                            <div class="flex items-center justify-between text-sm">
                                <span class="font-medium text-gray-600 dark:text-gray-300">Total estimado</span>
                                <span class="text-lg font-bold tabular-nums text-gray-900 dark:text-white">
                                    ${{ number_format((float) $totalPrecio, 2) }}
                                </span>
                            </div>
                        </div>
                    @endif

                    @auth
                        @if (auth()->user()->hasRole('cliente') && $totalUnidades > 0)
                            <form
                                action="{{ route('pedidos.store') }}"
                                method="POST"
                                class="mt-4 shrink-0 space-y-3 rounded-xl border border-indigo-100 bg-indigo-50/40 p-4 dark:border-indigo-900/50 dark:bg-indigo-950/20"
                            >
                                @csrf
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ __('Confirmar pedido') }}
                                </h3>
                                @if ($direcciones->isNotEmpty())
                                    <div class="space-y-1">
                                        <label
                                            for="direccion_id"
                                            class="block text-xs font-medium text-gray-600 dark:text-gray-300"
                                        >
                                            {{ __('Dirección guardada') }}
                                        </label>
                                        <select
                                            id="direccion_id"
                                            name="direccion_id"
                                            class="block w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white"
                                        >
                                            <option value="">{{ __('Escribir otra dirección abajo') }}</option>
                                            @foreach ($direcciones as $dir)
                                                <option value="{{ $dir->id }}" @selected(old('direccion_id') == $dir->id)>
                                                    {{ \Illuminate\Support\Str::limit($dir->direccion, 48) }}
                                                    @if ($dir->ciudad)
                                                        — {{ $dir->ciudad }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        <a
                                            href="{{ route('direcciones.index') }}"
                                            class="font-medium text-indigo-600 underline decoration-indigo-600/30 hover:text-indigo-500 dark:text-indigo-400"
                                        >
                                            {{ __('Gestionar direcciones') }}
                                        </a>
                                    </p>
                                @endif
                                <div class="space-y-1">
                                    <label
                                        for="direccion_entrega"
                                        class="block text-xs font-medium text-gray-600 dark:text-gray-300"
                                    >
                                        @if ($direcciones->isNotEmpty())
                                            {{ __('O escribe la dirección completa de entrega') }}
                                        @else
                                            {{ __('Dirección de entrega') }}
                                        @endif
                                    </label>
                                    <textarea
                                        id="direccion_entrega"
                                        name="direccion_entrega"
                                        rows="3"
                                        class="block w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-800 dark:text-white"
                                        placeholder="{{ __('Calle, número, colonia, ciudad, referencias…') }}"
                                    >{{ old('direccion_entrega') }}</textarea>
                                    @error('direccion_entrega')
                                        <p class="text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                <x-primary-button
                                    class="w-full justify-center normal-case tracking-normal text-sm"
                                >
                                    {{ __('Confirmar pedido') }}
                                </x-primary-button>
                            </form>
                        @endif
                    @endauth

                    <div class="mt-4 shrink-0 border-t border-gray-100 pt-4 dark:border-gray-700">
                        @auth
                            @php $user = auth()->user(); @endphp
                            @if ($user->hasRole('cliente'))
                                <a
                                    href="{{ route('cliente.index') }}"
                                    class="flex w-full items-center justify-center rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                                >
                                    {{ __('Ir a mi cuenta') }}
                                </a>
                            @elseif ($user->hasRole('superadmin'))
                                <a
                                    href="{{ url('/superadmin') }}"
                                    class="flex w-full items-center justify-center rounded-xl bg-gray-800 px-4 py-3 text-sm font-semibold text-white transition hover:bg-gray-700 dark:bg-gray-200 dark:text-gray-900 dark:hover:bg-white"
                                >
                                    {{ __('Ir al panel') }}
                                </a>
                            @elseif ($user->hasRole('admin'))
                                <a
                                    href="{{ url('/admin') }}"
                                    class="flex w-full items-center justify-center rounded-xl bg-gray-800 px-4 py-3 text-sm font-semibold text-white transition hover:bg-gray-700 dark:bg-gray-200 dark:text-gray-900 dark:hover:bg-white"
                                >
                                    {{ __('Ir al panel') }}
                                </a>
                            @else
                                <a
                                    href="{{ route('cliente.index') }}"
                                    class="flex w-full items-center justify-center rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500"
                                >
                                    {{ __('Ir a mi cuenta') }}
                                </a>
                            @endif
                        @else
                            <div x-data="{ open: false }" class="relative" @keydown.escape.window="open = false">
                                <button
                                    type="button"
                                    @click="open = !open"
                                    class="flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                                    :aria-expanded="open"
                                    aria-controls="checkout-auth-panel"
                                >
                                    {{ __('Continuar compra') }}
                                    <svg
                                        class="h-4 w-4 transition-transform duration-200"
                                        :class="{ 'rotate-180': open }"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        aria-hidden="true"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>

                                <div
                                    id="checkout-auth-panel"
                                    x-cloak
                                    x-show="open"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-1"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 translate-y-1"
                                    @click.outside="open = false"
                                    class="absolute left-0 right-0 z-30 mt-2 rounded-xl border border-gray-200 bg-white p-4 shadow-lg dark:border-gray-600 dark:bg-gray-800"
                                    role="region"
                                    aria-label="{{ __('Acceso para continuar') }}"
                                >
                                    <p class="mb-3 text-center text-xs text-gray-500 dark:text-gray-400">
                                        {{ __('Inicia sesión o crea una cuenta para continuar.') }}
                                    </p>
                                    <div class="flex flex-col gap-2 sm:flex-row">
                                        <a
                                            href="{{ route('login') }}"
                                            class="inline-flex flex-1 items-center justify-center rounded-lg bg-indigo-600 px-3 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-500"
                                        >
                                            {{ __('Iniciar sesión') }}
                                        </a>
                                        <a
                                            href="{{ route('register') }}"
                                            class="inline-flex flex-1 items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600"
                                        >
                                            {{ __('Registrarse') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </aside>
        </div>
    </div>
</x-app-layout>
