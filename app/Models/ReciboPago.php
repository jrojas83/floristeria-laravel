<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// aqui ya se hizo 10
class ReciboPago extends Model
{
    protected $table = 'recibos_pago';

    protected $fillable = [
        'pedido_id',
        'numero_recibo',
        'subtotal',
        'impuestos',
        'total',
        'estado',
        'visible',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleRecibo::class, 'recibo_id');
    }
}
