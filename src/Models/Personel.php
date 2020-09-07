<?php

namespace ayzamodul\department\Models;
use ayzamodul\department\Models\Sube;
use Illuminate\Database\Eloquent\Model;

class Personel extends Model
{


    protected $table='personel';
    protected $fillable=['il_id','sube_id','ad','soyad','email','telno','password','foto_ad','isAktif',"unvan_id"];
    const UPDATED_AT = null;
    const CREATED_AT = null;

    public function  sehir()
    {
        return $this->belongsTo('ayzamodul\department\Models\Sehir','il_id','id');
    }
    public function  sube()
    {
        return $this->belongsTo(Sube::class,'sube_id','id');
    }
    public function  unvan()
    {
        return $this->belongsTo('ayzamodul\department\Models\Unvan','unvan_id','id');
    }

}
