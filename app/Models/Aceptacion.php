<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//13
class Aceptacion extends Model
{   
    protected $fillable = [
    'user_id',
    'acepta_terminos',
    'acepta_privacidad'
    // 'fecha' se llena con CURRENT_TIMESTAMP
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
