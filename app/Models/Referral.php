<?php

namespace App\Models;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

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
        //donde almacenamos el referral_token
        $referral_token = Crypt::encryptString(str_random(10).$id);
        //instanciamos
        $referral = new Referral;
        //seteamos los datos
        $referral->user_id = $id;
        $referral->url = $url.'/'.$referral_token;
        $referral->own = 1;
        //guardamos el link referral
        $referral->save();
        //guardamos el referral_token en el usuario
        $user = User::findOrFail($id);
        $user->referral_token = $referral_token;
        $user->save();
    }

}
