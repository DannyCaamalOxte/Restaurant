<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    //
    protected $table='pedidos';

    protected $primaryKey='skup';

    public $incrementing=true;

    public $timestamps=false;

    protected $fillable=[
    	'skup',
    	'nombrep',
        'color',
        'sabor',
        'texto',
        'fecha',
        'hora',
        'sucursal',
        'telefono',
    	'preciop'
    ];


}
