<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// aqui ya se hizo 1
class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
