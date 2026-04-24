<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();

        $direcciones = Auth::check()
            ? Direccion::query()->where('user_id', Auth::id())->orderByDesc('id')->get()
            : collect();

        return view('productos.index', compact('productos', 'direcciones'));
    }

    public function show(string $id)
    {
        $producto = Producto::findOrFail($id);

        return view('productos.show', compact('producto'));
    }
}
