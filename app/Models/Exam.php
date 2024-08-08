<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = ['e_title', 'e_slug'];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'exam_questions');
    }

    public function examQuestionYears()
    {
        return $this->hasMany(ExamQuestionYear::class);
    }
}
