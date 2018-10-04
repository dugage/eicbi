<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseChapter extends Model
{
    protected $fillable = ['name','text','video','attached'];
    /**
     * Get the course that owns the comment.
     */
    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
}
