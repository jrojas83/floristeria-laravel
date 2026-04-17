<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoProducto extends Model
{  
    protected $table = 'estados_producto'; 
    protected $fillable = ['nombre'];
    public $timestamps = false;


    public function productos()
    {
        return $this->hasMany(Producto::class, 'estado_id');
    }
}

