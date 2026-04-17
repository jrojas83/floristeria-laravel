<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//aqui ya se hizo 3
class Pedido extends Model
{   

    protected $fillable = [
    'user_id',
    'direccion_id',
    'direccion_texto',
    'estado_id',
    'total',
    'activo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function direccion()
    {
        return $this->belongsTo(Direccion::class);
    }

    public function estado()
    {
        return $this->belongsTo(EstadoPedido::class, 'estado_id');
    }

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function historial()
    {
        return $this->hasMany(HistorialEstadoPedido::class);
    }  //
}
