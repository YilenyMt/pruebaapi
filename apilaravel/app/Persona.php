<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';
    protected $fillable = [
        'nombrePersona', 'apellidosPersona', 'telefonoPersona','generoPersona','fechaNacimientoPersona',
    ];

    /*public function User(){
        return $this->hasOne(User::class);
    }*/
}
