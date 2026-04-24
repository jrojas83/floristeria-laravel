<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// aqui ya se hizo 9
class EstadoPago extends Model
{
    protected $table = 'estados_pago';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'estado_id');
    }
}
