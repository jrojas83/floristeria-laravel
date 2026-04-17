<?php

namespace App\Http\Controllers;

use App\Models\Producto;

class MenuController extends Controller
{
    public function index()
    {
        $productos = Producto::where('activo', 1)->get();
        return view('menu.index', compact('productos'));
    }
}