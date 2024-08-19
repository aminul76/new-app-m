<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;


    protected $fillable = ['subject_id', 't_title', 't_slug'];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
   


}
