<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelTestQuestion extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'model_test_questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model_test_id',
        'subject_id',
        'topic_id',
        'question_id',
    ];

    /**
     * Get the model test associated with the question.
     */
    public function modelTest()
    {
        return $this->belongsTo(ModelTest::class);
    }

    /**
     * Get the subject associated with the question.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Get the topic associated with the question.
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Get the question associated with the model test question.
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
