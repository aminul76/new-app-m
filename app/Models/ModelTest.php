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
        'm_description',
        'mark',
        'set_time',
        'start_date',
        'end_date',
    ];

    // Optionally, you can define relationships if needed
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
   // Relationship to ModelTestQuestion
   public function modelTestQuestions()
   {
       return $this->hasMany(ModelTestQuestion::class);
   }

   // Relationship to Question through ModelTestQuestion
   public function questions()
   {
       return $this->hasMany(ModelTestQuestion::class);
   }

   public function userExamRecords()
   {
       return $this->hasMany(UserExamRecord::class, 'modeltest_id');
   }
}
