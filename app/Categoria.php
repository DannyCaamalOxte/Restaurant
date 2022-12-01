<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
    protected $table='categorias';
    protected $primaryKey='id_categoria';
    protected $with=['productos'];
    public $timestamps=false;

    protected $fillable=[
    	'id_categoria',
    	'categoria'
    ];
    public function productos(){
        //la relacion has many permite llamar a varios datos con un mismo valor en comun de la llave foranea
        // se hace uso de un modelo, el primer campo en comillas hace referencia a un valor dentro del modelo producto
        // el segundo campo entre comillas hace referencia al campo de este modelo
        return $this->hasMany(Platos::class,'categoria','id_categoria');
    }

}
