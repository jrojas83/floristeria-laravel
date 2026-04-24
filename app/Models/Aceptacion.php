<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// 13
class Aceptacion extends Model
{
    protected $table = 'aceptaciones';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'acepta_terminos',
        'acepta_privacidad',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
