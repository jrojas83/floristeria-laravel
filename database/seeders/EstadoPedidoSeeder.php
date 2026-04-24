<?php

namespace Database\Seeders;

use App\Models\EstadoPedido;
use Illuminate\Database\Seeder;

class EstadoPedidoSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Pendiente', 'Confirmado', 'En envío', 'Entregado', 'Cancelado'] as $nombre) {
            EstadoPedido::firstOrCreate(['nombre' => $nombre]);
        }
    }
}
