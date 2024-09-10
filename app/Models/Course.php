<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'c_title',
        'c_slug',
        'c_description',
        'c_colour',
        'c_image',
        'c_seo_title',
        'c_seo_image',
        'c_seo_description',
        'c_keyword',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function questions()
    {
        return $this->belongsToMany(Question::class, 'course_questions');
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'course_topics');
    }


}
