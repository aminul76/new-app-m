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
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'course_topics');
    }


}
