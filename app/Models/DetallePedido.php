<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//aqui ya se hizo 4
class DetallePedido extends Model
{   
    protected $fillable = [
    'pedido_id',
    'producto_id',
    'cantidad',
    'precio_unitario',
    'subtotal',
    'mensaje',
    'dedicatoria',
    'activo'
    ];
    
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }    
}
