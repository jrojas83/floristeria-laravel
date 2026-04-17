<x-app-layout>

    <x-slot name="header">
        <h2>Productos</h2>
    </x-slot>

    <div style="display: flex;">
        
        <!-- PRODUCTOS -->
        <div style="width: 70%;">
            @foreach($productos as $producto)
                <div style="border:1px solid #ccc; margin:10px; padding:10px;">
                    <h3>{{ $producto->nombre }}</h3>
                    <p>${{ $producto->precio }}</p>

                    <form action="{{ route('carrito.add', $producto->id) }}" method="POST">
                        @csrf
                        <button type="submit">Agregar</button>
                    </form>
                </div>
            @endforeach
        </div>

        <!-- CARRITO -->
        <div style="width: 30%; border-left: 2px solid #ccc; padding:10px;">
            <h2>Carrito</h2>

            @php
                $carrito = session('carrito', []);
            @endphp

            @forelse($carrito as $id => $item)
                <div>
                    <p>{{ $item['nombre'] }}</p>
                    <p>{{ $item['cantidad'] }}</p>

                    <form action="{{ route('carrito.remove', $id) }}" method="POST">
                        @csrf
                        <button type="submit">Eliminar</button>
                    </form>
                </div>
            @empty
                <p>Carrito vacío</p>
            @endforelse
        </div>

    </div>

</x-app-layout>