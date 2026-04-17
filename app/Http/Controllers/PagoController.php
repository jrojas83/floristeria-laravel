<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;

class PagoController extends Controller
{
    public function store(Request $request)
    {
        Pago::create([
            'pedido_id' => $request->pedido_id,
            'metodo_pago_id' => $request->metodo_pago_id,
            'estado_id' => 1,
            'monto' => $request->monto
        ]);

        return redirect()->back();
    }
}