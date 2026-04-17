<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\ProfileController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// PUBLICO
Route::get('/', [ProductoController::class, 'index'])->name('menu.index');
Route::get('/producto/{id}', [ProductoController::class, 'show'])->name('productos.show');

Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/agregar/{id}', [CarritoController::class, 'add'])->name('carrito.add');
Route::post('/carrito/eliminar/{id}', [CarritoController::class, 'remove'])->name('carrito.remove');

// PRIVADO
Route::middleware(['auth'])->group(function () {

    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::post('/pedidos/confirmar', [PedidoController::class, 'store'])->name('pedidos.store');

    Route::resource('direcciones', DireccionController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');


    Route::middleware(['role:superadmin'])->group(function () {
        Route::get('/superadmin', function () {
            return view('superadmin.index');
        });
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', function () {
            return view('admin.index');
        });
    });

    Route::middleware(['role:cliente'])->group(function () {
        Route::get('/cliente', function () {
            return view('cliente.index');
        });
    });

});

// AUTH
require __DIR__.'/auth.php';