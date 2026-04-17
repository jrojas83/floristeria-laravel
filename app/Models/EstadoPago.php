<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//aqui ya se hizo 9
class EstadoPago extends Model
{   
    protected $fillable = [
    'nombre'
];

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
