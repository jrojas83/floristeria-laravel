<?php

namespace App\Http\Controllers;

use App\Models\DetallePedido;
use App\Models\Direccion;
use App\Models\EstadoPedido;
use App\Models\Pedido;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PedidoController extends Controller
{
    public function index(): View
    {
        $pedidos = Pedido::query()
            ->where('user_id', Auth::id())
            ->with('estado')
            ->orderByDesc('id')
            ->get();

        return view('pedidos.index', compact('pedidos'));
    }

    public function store(Request $request): RedirectResponse
    {
        $carrito = session()->get('carrito', []);

        if (empty($carrito)) {
            return redirect()->back()->with('error', 'Tu carrito está vacío.');
        }

        $validated = $request->validate([
            'direccion_id' => ['nullable', 'integer', 'exists:direcciones,id'],
            'direccion_entrega' => ['nullable', 'string', 'max:2000'],
        ]);

        $direccionId = null;
        $direccionTexto = null;

        if (! empty($validated['direccion_id'])) {
            $dir = Direccion::query()
                ->where('user_id', Auth::id())
                ->whereKey($validated['direccion_id'])
                ->firstOrFail();
            $direccionId = $dir->id;
            $partes = array_filter([
                trim($dir->direccion),
                $dir->ciudad ? trim($dir->ciudad) : null,
                $dir->referencia ? 'Ref: '.trim($dir->referencia) : null,
            ]);
            $direccionTexto = implode(' · ', $partes);
        } elseif (! empty($validated['direccion_entrega'])) {
            $direccionTexto = trim($validated['direccion_entrega']);
        }

        if ($direccionTexto === null || $direccionTexto === '') {
            return redirect()->back()->withErrors([
                'direccion_entrega' => 'Indica una dirección de entrega o selecciona una guardada.',
            ])->withInput();
        }

        $estadoPendiente = EstadoPedido::query()->where('nombre', 'Pendiente')->firstOrFail();

        $pedido = Pedido::create([
            'user_id' => Auth::id(),
            'direccion_id' => $direccionId,
            'direccion_texto' => $direccionTexto,
            'estado_id' => $estadoPendiente->id,
            'total' => 0,
        ]);

        $total = 0.0;

        foreach ($carrito as $id => $item) {
            $subtotal = (float) $item['precio'] * (int) $item['cantidad'];

            DetallePedido::create([
                'pedido_id' => $pedido->id,
                'producto_id' => (int) $id,
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio'],
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        $pedido->update(['total' => $total]);

        session()->forget('carrito');

        return redirect()->route('pedidos.show', $pedido)->with('success', 'Tu pedido se ha registrado correctamente.');
    }

    public function show(int $id): View
    {
        $pedido = Pedido::query()
            ->where('user_id', Auth::id())
            ->with(['detalles.producto', 'estado', 'direccion'])
            ->findOrFail($id);

        return view('pedidos.show', compact('pedido'));
    }
}
