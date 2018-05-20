<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 'alumnos';
    
    protected $fillable = ['nombre','apellido','telefono','email','matricula'];
    
    protected $dates = ['created_at','updated_at','deleted_at'];
}
