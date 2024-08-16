<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\course;
use App\Models\Topic;

use Illuminate\Support\Facades\DB;
class FrontendController extends Controller
{
   public function index(){

    $courses = Course::all();
    return view('frontend.index',compact('courses'));

   }
   public function courses($slug)
   {



    $course = Course::select('courses.*')
        ->join('course_subject', 'courses.id', '=', 'course_subject.course_id')
        ->join('subjects', 'course_subject.subject_id', '=', 'subjects.id')
        ->addSelect('subjects.s_title', 'subjects.s_slug')
        ->where('courses.c_slug', $slug)
        ->first();

    if (!$course) {
        abort(404, 'Course not found');
    }

    // Retrieve all subjects separately for view
    $subjects = DB::table('subjects')
        ->join('course_subject', 'subjects.id', '=', 'course_subject.subject_id')
        ->where('course_subject.course_id', $course->id)
        ->get();

    return view('frontend.course', ['course' => $course, 'subjects' => $subjects]);

   }

   public function topic($courseSlug, $subjectSlug)
   {
       // Retrieve the course and associated subjects and topics
       $course = Course::select('courses.*')
       ->join('course_subject', 'courses.id', '=', 'course_subject.course_id')
       ->join('subjects', 'course_subject.subject_id', '=', 'subjects.id')
       ->addSelect('subjects.s_title', 'subjects.s_slug')
       ->where('courses.c_slug', $courseSlug)
       ->first();

   if (!$course) {
       abort(404, 'Course not found');
   }

   // Retrieve all subjects separately for view
        $subject = DB::table('subjects')

       ->join('course_subject', 'subjects.id', '=', 'course_subject.subject_id')
       ->where('course_subject.course_id', $course->id)
       ->where('subjects.s_slug', $subjectSlug)
       ->select('subjects.id as subject_id')
       ->first();

       if (!$subject) {
        abort(404, 'Course not found');
    }

       $topics = DB::table('topics')

       ->join('course_topics', 'topics.id', '=', 'course_topics.topic_id')
       ->where('course_topics.course_id', $course->id)
       ->where('topics.subject_id',  $subject->subject_id)
       ->get();


       if (!$topics) {
        abort(404, 'Course not found');
    }




       return view('frontend.course_topic', [
           'course' => $course,
           'subject' => $subject,
           'topics' => $topics
       ]);
   }
}
