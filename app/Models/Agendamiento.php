<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// 12
class Agendamiento extends Model
{
    protected $table = 'agendamientos';

    public $timestamps = false;

    protected $fillable = [
        'pedido_id',
        'fecha',
        'hora',
        'direccion_entrega',
        'activo',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
