<?php

namespace ayzamodul\department\Models;

use Illuminate\Database\Eloquent\Model;

class Sehir extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected  $table='sehir';

    protected $fillable = ['id','ad','plaka','isAktif'];

    public function  sube()
    {
        return $this->hasMany('ayzamodul\department\Models\Sube','il_id','id')->where('isDelete',0);
    }
    public function personel(){
        return $this->hasMany('ayzamodul\department\Models\Personel','il_id','id');
    }



}
