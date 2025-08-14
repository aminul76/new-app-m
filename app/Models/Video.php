<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

// Define the fillable fields for mass assignment
    protected $fillable = [
        'title', 
        'course_id', 
        'status', 
        'm_description', 
        'video_link', 
        'pdf_link', 
        'class_test_link',
        'mark', 
        'start_date', 
        'end_date'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    // Define the relationship between Video and Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
