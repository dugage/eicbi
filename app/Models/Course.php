<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * Get the chapters for the blog post.
     */
    public function chapters()
    {
        return $this->hasMany('App\Models\CourseChapter');
    }
}
