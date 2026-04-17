<x-app-layout>
    <h1>{{ $producto->nombre }}</h1>

    <p>{{ $producto->descripcion }}</p>
    <p>${{ $producto->precio }}</p>

    <form action="{{ route('carrito.add', $producto->id) }}" method="POST">
        @csrf
        <button type="submit">Agregar al carrito</button>
    </form>

    <a href="{{ route('menu.index') }}">Volver</a>
</x-app-layout>