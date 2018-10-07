<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','card_number','country','city',
        'address','prefix','telephone','parent'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','parent'
    ];

    protected $dates = ['deleted_at'];

    public function deleteOrRestore()
    {
        ($this->trashed()) ? $this->restore() : $this->delete();
        return $this;
    }
    
    //relaciones
    public function referral()
    {
        return $this->hasMany('App\Models\Referral');
    }
    //Mutators
    public function setTelephoneAttribute($value)
    {
        if( $value != '')
            $this->attributes['telephone'] = str_replace(' ', '', $value);
    }

    public function setCardNumberAttribute($value)
    {
        $this->attributes['card_number'] = str_replace(' ', '', $value);
    }
    // Accesors
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }


}
