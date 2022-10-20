<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVentat extends Model
{
    //
    protected $table='detalle_ventast';
    protected $primaryKey='id';
    protected $with=['productost'];
    public $incrementing=true;
    public $timestamps=false;
    public $fillable=[
    	'skut',
    	'cantidadt',
    	'preciot',
    	'total',
    	'folio'
    ];
    public function productost(){
        return $this->belongsTo(Productot::class,'skut','skut');
    }
}
