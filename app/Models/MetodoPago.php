<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//aqui ya se hizo 7
class MetodoPago extends Model
{   
    protected $fillable = [
    'nombre',
    'activo'
    ];

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
