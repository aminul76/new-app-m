<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModelAnswer extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'model_test_id',
        'question_id',
        'option_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function modelTest()
    {
        return $this->belongsTo(ModelTest::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
    
}
