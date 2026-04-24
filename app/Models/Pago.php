<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// aqui ya se hizo 6
class Pago extends Model
{
    protected $table = 'pagos';

    public $timestamps = false;

    protected $fillable = [
        'pedido_id',
        'metodo_pago_id',
        'estado_id',
        'monto',
        'activo',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function metodo()
    {
        return $this->belongsTo(MetodoPago::class, 'metodo_pago_id');
    }

    public function estado()
    {
        return $this->belongsTo(EstadoPago::class, 'estado_id');
    }
}
