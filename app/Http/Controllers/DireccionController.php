<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DireccionController extends Controller
{
    public function index(): View
    {
        $direcciones = Direccion::query()
            ->where('user_id', Auth::id())
            ->orderByDesc('id')
            ->get();

        return view('direcciones.index', compact('direcciones'));
    }

    public function create(): View
    {
        return view('direcciones.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'direccion' => ['required', 'string', 'max:2000'],
            'ciudad' => ['nullable', 'string', 'max:120'],
            'referencia' => ['nullable', 'string', 'max:500'],
        ]);

        Direccion::create([
            'user_id' => Auth::id(),
            'direccion' => $validated['direccion'],
            'ciudad' => $validated['ciudad'] ?? null,
            'referencia' => $validated['referencia'] ?? null,
        ]);

        return redirect()->route('direcciones.index')->with('success', 'Dirección guardada.');
    }

    public function edit(string $id): View
    {
        $direccion = Direccion::query()->where('user_id', Auth::id())->findOrFail($id);

        return view('direcciones.edit', compact('direccion'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $direccion = Direccion::query()->where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'direccion' => ['required', 'string', 'max:2000'],
            'ciudad' => ['nullable', 'string', 'max:120'],
            'referencia' => ['nullable', 'string', 'max:500'],
        ]);

        $direccion->update($validated);

        return redirect()->route('direcciones.index')->with('success', 'Dirección actualizada.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $direccion = Direccion::query()->where('user_id', Auth::id())->findOrFail($id);
        $direccion->delete();

        return redirect()->route('direcciones.index')->with('success', 'Dirección eliminada.');
    }
}
