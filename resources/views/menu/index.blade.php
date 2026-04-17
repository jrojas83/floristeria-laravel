<x-app-layout>
    <h1>Menú principal</h1>

    @foreach($productos as $producto)
        <div>
            <h3>{{ $producto->nombre }}</h3>
            <p>${{ $producto->precio }}</p>

            <a href="{{ route('productos.show', $producto->id) }}">
                Ver producto
            </a>
        </div>
    @endforeach
</x-app-layout>