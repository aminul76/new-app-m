<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeckRecoard extends Model
{
    use HasFactory;
    protected $fillable = [
        'fack_user_id',
        'modeltest_id',
        'correct_answers_count',
        'incorrect_answers_count',
    ];

    public function fackusers()
    {
        return $this->belongsTo(FackUser::class, 'fack_user_id');
    }

    public function modelTest()
    {
        return $this->belongsTo(ModelTest::class, 'modeltest_id');
    }

}
