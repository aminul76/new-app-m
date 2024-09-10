<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExamRecord extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'modeltest_id','correct_answers_count','incorrect_answers_count','modeltest_count'];

    public function modelTest()
    {
        return $this->belongsTo(ModelTest::class, 'modeltest_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
