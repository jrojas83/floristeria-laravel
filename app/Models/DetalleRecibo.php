<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleRecibo extends Model
{
    protected $table = 'detalle_recibo';

    protected $fillable = [
        'recibo_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal'
    ];

    public function recibo()
    {
        return $this->belongsTo(ReciboPago::class, 'recibo_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}