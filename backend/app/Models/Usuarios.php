<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    public $timestamps = false;
    protected $table = 'usuarios';

    //evitamos que la password no se devuelva en las consultas
    protected $hidden = [
        'password',
    ];

    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'email',
        'password'
    ];

}
