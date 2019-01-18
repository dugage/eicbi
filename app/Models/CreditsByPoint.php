<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditsByPoint extends Model
{
    public $timestamps = false;
    public $updated_at = false;
    protected $fillable = ['credits'];
}
