<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            [
                'nombre' => 'Ramo de Rosas Rojas',
                'descripcion' => 'Clásico ramo de 12 rosas frescas',
                'precio' => 45000,
                'stock' => 15,
                'estado_id' => 1,
                'categoria_id' => 1
            ],
            [
                'nombre' => 'Orquídea Phalaenopsis',
                'descripcion' => 'Orquídea blanca en maceta decorativa',
                'precio' => 85000,
                'stock' => 8,
                'estado_id' => 1,
                'categoria_id' => 2
            ],
            [
                'nombre' => 'Arreglo de Girasoles',
                'descripcion' => 'Caja con 6 girasoles y follaje silvestre',
                'precio' => 60000,
                'stock' => 10,
                'estado_id' => 1,
                'categoria_id' => 1
            ],
            [
                'nombre' => 'Lirios Blancos',
                'descripcion' => 'Ramo elegante de lirios aromáticos',
                'precio' => 55000,
                'stock' => 12,
                'estado_id' => 1,
                'categoria_id' => 1
            ],
            [
                'nombre' => 'Bonsái Ficus',
                'descripcion' => 'Árbol de interior de 5 años de edad',
                'precio' => 110000,
                'stock' => 5,
                'estado_id' => 1,
                'categoria_id' => 2
            ],
            [
                'nombre' => 'Caja de Tulipanes',
                'descripcion' => 'Mezcla de tulipanes de colores importados',
                'precio' => 95000,
                'stock' => 7,
                'estado_id' => 1,
                'categoria_id' => 1
            ],
            [
                'nombre' => 'Suculenta en Miniatura',
                'descripcion' => 'Variedad de suculenta en maceta de barro',
                'precio' => 15000,
                'stock' => 25,
                'estado_id' => 1,
                'categoria_id' => 2
            ],
            [
                'nombre' => 'Ramo de Margaritas',
                'descripcion' => 'Arreglo alegre y campestre',
                'precio' => 35000,
                'stock' => 20,
                'estado_id' => 1,
                'categoria_id' => 1
            ],
            [
                'nombre' => 'Planta de Anturio',
                'descripcion' => 'Planta con flores rojas duraderas',
                'precio' => 50000,
                'stock' => 6,
                'estado_id' => 1,
                'categoria_id' => 2
            ],
            [
                'nombre' => 'Corona Fúnebre Premium',
                'descripcion' => 'Arreglo formal de flores blancas',
                'precio' => 180000,
                'stock' => 3,
                'estado_id' => 1,
                'categoria_id' => 3
            ],
        ];

        foreach ($productos as $producto) {
            Producto::updateOrCreate(
                ['nombre' => $producto['nombre']], // clave única
                $producto
            );
        }
    }
}