<?php

namespace ayzamodul\department\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Sube extends Model
{
    use Notifiable;
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $table='subeler';
    protected $fillable=['il_id','ad','adres','email','telno1','telno2','link','harita','foto_ad','isAktif'];

    public function  il()
    {
        return $this->belongsTo('ayzamodul\department\Models\Sehir','il_id','id');
    }
    public function personel(){
        return $this->hasMany('ayzamodul\department\Models\Personel','sube_id','id');
    }

}
