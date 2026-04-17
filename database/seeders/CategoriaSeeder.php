<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        Categoria::updateOrCreate(['id' => 1], ['nombre' => 'Cumpleaños']);
        Categoria::updateOrCreate(['id' => 2], ['nombre' => 'Amor']);
        Categoria::updateOrCreate(['id' => 3], ['nombre' => 'Fúnebre']);
    }
}