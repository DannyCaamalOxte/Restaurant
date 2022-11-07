<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platos extends Model
{
    //
    protected $table='platillo';
    protected $primaryKey='id_platillo';
    public $timestamps=false;

    protected $fillable=[
    	'id_platillo',
    	'nombre',
    	'precio',
    	'comentario'
    ];
}
