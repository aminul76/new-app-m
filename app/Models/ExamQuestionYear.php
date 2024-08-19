<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestionYear extends Model
{
    use HasFactory;
    protected $fillable = ['exam_id', 'year_id', 'question_id'];
    
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
