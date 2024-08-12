<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['c_title', 'c_slug'];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'course_questions');
    }

}
