<x-app-layout>
    <h1>Carrito</h1>

    @if(session('carrito') && count(session('carrito')) > 0)
        @foreach(session('carrito') as $id => $item)
            <div>
                <h3>{{ $item['nombre'] }}</h3>
                <p>Cantidad: {{ $item['cantidad'] }}</p>
                <p>Precio: ${{ $item['precio'] }}</p>

                <form action="{{ route('carrito.remove', $id) }}" method="POST">
                    @csrf
                    <button type="submit">Eliminar</button>
                </form>
            </div>
            <hr>
        @endforeach
    @else
        <p>Carrito vacío</p>
    @endif
</x-app-layout>