<x-app-layout>
    <h1>Productos</h1>

    @if($productos->count())
        @foreach ($productos as $producto)
            <div style="border:1px solid #ccc; padding:10px; margin:10px;">
                <h2>{{ $producto->nombre }}</h2>
                <p>{{ $producto->descripcion }}</p>
                <p>${{ $producto->precio }}</p>

                <a href="{{ route('productos.show', $producto->id) }}">
                    Ver detalle
                </a>

                <form action="{{ route('carrito.add', $producto->id) }}" method="POST">
                    @csrf
                    <button type="submit">Agregar al carrito</button>
                </form>
            </div>
        @endforeach
    @else
        <p>No hay productos en la base de datos</p>
    @endif

</x-app-layout>