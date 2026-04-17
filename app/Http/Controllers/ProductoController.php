<?php

namespace App\Http\Controllers;

use App\Models\Producto;

class ProductoController extends Controller
{
public function index()
{
    $productos = \App\Models\Producto::all();
    return view('productos.index', compact('productos'));
}
}