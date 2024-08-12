<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelTest extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'course_id',
        'status',
        'start_date',
        'end_date',
    ];

    // Optionally, you can define relationships if needed
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'model_test_questions')
                    ->withPivot('subject_id', 'topic_id')
                    ->withTimestamps();
    }
}
