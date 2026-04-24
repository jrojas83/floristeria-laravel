<?php

namespace App\Models;

// 11
use Illuminate\Database\Eloquent\Model;

class HistorialEstadoPedido extends Model
{
    protected $table = 'historial_estados_pedido';

    public $timestamps = false;

    protected $fillable = [
        'pedido_id',
        'estado_id',
        'comentario',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function estado()
    {
        return $this->belongsTo(EstadoPedido::class, 'estado_id');
    }
}
