<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::where('user_id', Auth::id())->get();
        return view('pedidos.index', compact('pedidos'));
    }

    public function store()
    {
        $carrito = session()->get('carrito', []);

        if(empty($carrito)) {
            return redirect()->back();
        }

        $pedido = Pedido::create([
            'user_id' => Auth::id(),
            'estado_id' => 1,
            'total' => 0
        ]);

        $total = 0;

        foreach($carrito as $id => $item) {
            $subtotal = $item['precio'] * $item['cantidad'];

            DetallePedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => $id,
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio'],
                'subtotal' => $subtotal
            ]);

            $total += $subtotal;
        }

        $pedido->update(['total' => $total]);

        session()->forget('carrito');

        return redirect()->route('pedidos.index');
    }

    public function show($id)
    {
        $pedido = Pedido::findOrFail($id);
        return view('pedidos.show', compact('pedido'));
    }
}