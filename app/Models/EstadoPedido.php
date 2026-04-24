<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// aqui ya se hizo 8
class EstadoPedido extends Model
{
    protected $table = 'estados_pedido';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'estado_id');
    }
}
