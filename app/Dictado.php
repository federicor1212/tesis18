<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dictado extends Model
{
    protected $table = 'dictados';
    
    protected $fillable = ['id_materia','cuat','ano','alt_hor','cant_insc_act','cant_clases','cant_faltas_max','fecha_inicio','fecha_fin'];
    
    protected $dates = ['created_at','updated_at','deleted_at'];
}
