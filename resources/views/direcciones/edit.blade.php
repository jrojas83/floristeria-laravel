<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Editar dirección') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <div
            class="overflow-hidden rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800"
        >
            <form action="{{ route('direcciones.update', $direccion) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')
                <div>
                    <x-input-label for="direccion" :value="__('Dirección')" />
                    <textarea
                        id="direccion"
                        name="direccion"
                        rows="4"
                        required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100"
                    >{{ old('direccion', $direccion->direccion) }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('direccion')" />
                </div>
                <div>
                    <x-input-label for="ciudad" :value="__('Ciudad (opcional)')" />
                    <x-text-input
                        id="ciudad"
                        name="ciudad"
                        type="text"
                        class="mt-1 block w-full"
                        :value="old('ciudad', $direccion->ciudad)"
                    />
                    <x-input-error class="mt-2" :messages="$errors->get('ciudad')" />
                </div>
                <div>
                    <x-input-label for="referencia" :value="__('Referencias (opcional)')" />
                    <textarea
                        id="referencia"
                        name="referencia"
                        rows="2"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100"
                    >{{ old('referencia', $direccion->referencia) }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('referencia')" />
                </div>
                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                    <a
                        href="{{ route('direcciones.index') }}"
                        class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700"
                    >
                        {{ __('Cancelar') }}
                    </a>
                    <x-primary-button>{{ __('Actualizar') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
