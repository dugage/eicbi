<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    // Accesors
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
    //metodo que crea url internas de referidos de cada usuario
    static function setReferralOwn($url,$id)
    {
        //instanciamos
        $referral = new Referral;
        //seteamos los datos
        $referral->user_id = $id;
        $referral->url = $url.'/'.str_random(10).$id;
        $referral->own = 1;
        //guardamos el link referral
        $referral->save();
    }

}
