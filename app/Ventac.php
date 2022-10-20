<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class ventac extends Model
{
    //
    protected $with=['detalles'];
    protected $table='ventasc';
    protected $primaryKey='folio';
    public $incrementing=false;
    public $timestamps=false;

    protected $fillable=[
    	'folio',
    	'fecha_venta',
    	'num_articulos',
    	'subtotal',
    	'iva',
    	'total'
    ];
    public function detalles(){
        return $this->hasMany('App\DetalleVentac','folio',);
        }
}
