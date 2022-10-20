<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productot extends Model
{
    //
    protected $table='productost';

    protected $primaryKey='skut';

    public $incrementing=false;

    public $timestamps=false;

    protected $fillable=[
        'skut',
        'nombret',
        'preciot',
        'cantidadt'
    ];


}
