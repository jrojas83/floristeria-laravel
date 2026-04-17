<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EstadoProducto;

class EstadoProductoSeeder extends Seeder
{
    public function run(): void
    {
        EstadoProducto::updateOrCreate(['id' => 1], ['nombre' => 'activo']);
        EstadoProducto::updateOrCreate(['id' => 2], ['nombre' => 'inactivo']);
    }
}