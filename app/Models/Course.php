<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name','amount','short_description'];
    
    //relaciones
    public function chapters()
    {
        return $this->hasMany('App\Models\CourseChapter');
    }

    public function userCourses()
    {
        return $this->hasOne('App\Models\UserCourse');
    }
}
