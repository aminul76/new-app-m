<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['subject_id', 'topic_id', 'q_title', 'q_slug', 'q_explain'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_questions');
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_questions');
    }

    public function years()
    {
        return $this->belongsToMany(Year::class, 'question_years');
    }


    public function examQuestionYears()
    {
        return $this->hasMany(ExamQuestionYear::class);
    }
}
