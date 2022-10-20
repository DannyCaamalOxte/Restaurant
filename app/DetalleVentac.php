<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVentac extends Model
{
    //
    protected $table='detalle_ventasc';
    protected $primaryKey='id';
    protected $with=['productosc'];
    public $incrementing=true;
    public $timestamps=false;
    public $fillable=[
    	'skuc',
    	'cantidadc',
    	'precioc',
    	'total',
    	'folio'
    ];
    public function productosc(){
        return $this->belongsTo(Productoc::class,'skuc','skuc');
    }
}
