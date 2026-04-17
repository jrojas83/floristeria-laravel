<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoProducto extends Model
{   
    protected $fillable = [
    'nombre'
];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'estado_id');
    }
}

