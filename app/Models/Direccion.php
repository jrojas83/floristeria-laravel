<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//aqui ya se hizo 5
class Direccion extends Model
{   
    protected $fillable = [
    'user_id',
    'direccion',
    'ciudad',
    'referencia',
    'activo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    } 
}
