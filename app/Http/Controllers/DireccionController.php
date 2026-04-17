<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direccion;
use Illuminate\Support\Facades\Auth;

class DireccionController extends Controller
{
    public function index()
    {
        $direcciones = Direccion::where('user_id', Auth::id())->get();
        return view('direcciones.index', compact('direcciones'));
    }

    public function create()
    {
        return view('direcciones.create');
    }

    public function store(Request $request)
    {
        Direccion::create([
            'user_id' => Auth::id(),
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad
        ]);

        return redirect()->route('direcciones.index');
    }

    public function edit($id)
    {
        $direccion = Direccion::findOrFail($id);
        return view('direcciones.edit', compact('direccion'));
    }

    public function update(Request $request, $id)
    {
        $direccion = Direccion::findOrFail($id);

        $direccion->update($request->all());

        return redirect()->route('direcciones.index');
    }

    public function destroy($id)
    {
        Direccion::destroy($id);
        return redirect()->route('direcciones.index');
    }
}