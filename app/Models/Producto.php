<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//aqui ya se hizo 2
class Producto extends Model
{   

    protected $fillable = [
    'nombre',
    'descripcion',
    'precio',
    'stock',
    'imagen',
    'estado_id',
    'categoria_id',
    'activo'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function estado()
    {
        return $this->belongsTo(EstadoProducto::class, 'estado_id');
    }

    public function detallesPedido()
    {
        return $this->hasMany(DetallePedido::class);
    }
}
