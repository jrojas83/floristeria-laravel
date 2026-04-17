@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

@foreach($carrito as $id => $item)
    <p>{{ $item['nombre'] }}</p>
    <p>${{ $item['precio'] }}</p>

    <form action="{{ route('carrito.update', $id) }}" method="POST">
        @csrf
        <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1">
        <button type="submit">Actualizar</button>
    </form>

    <a href="{{ route('carrito.remove', $id) }}">Eliminar</a>
@endforeach

<a href="{{ route('carrito.clear') }}">Vaciar carrito</a>