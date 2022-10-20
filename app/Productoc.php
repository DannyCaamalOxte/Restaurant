<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productoc extends Model
{
    //
    protected $table='productosc';

    protected $primaryKey='skuc';

    public $incrementing=false;

    public $timestamps=false;

    protected $fillable=[
    	'skuc',
    	'nombrec',
    	'precioc',
    	'cantidadc'
    ];


}
