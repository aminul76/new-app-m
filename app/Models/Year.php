<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;
    protected $fillable = ['y_title', 'y_slug'];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_years');
    }

    public function examQuestionYears()
    {
        return $this->hasMany(ExamQuestionYear::class);
    }
}
