<?php

namespace ayzamodul\department\Models;

use Illuminate\Database\Eloquent\Model;

class Unvan extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected  $table='unvan';

    protected $fillable = ['id','unvan','isAktif'];

    public function personel(){
        return $this->hasMany('ayzamodul\department\Models\Personel','unvan_id','id');
    }


}
