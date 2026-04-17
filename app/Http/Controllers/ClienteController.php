<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('cliente.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $user->update($request->all());

        return redirect()->back();
    }
}