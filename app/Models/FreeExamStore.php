<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeExamStore extends Model
{
    use HasFactory;
      protected $fillable = [
        'user_name',
        'ip_address',
        'mobile_ip',
        'user_phone',
        'modeltest_id',
        'modeltest_count',
        'correct_answers_count',
        'incorrect_answers_count',
    ];
}
