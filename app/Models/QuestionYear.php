<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionYear extends Model
{
    use HasFactory;
    protected $fillable = ['year_id', 'question_id'];
}
