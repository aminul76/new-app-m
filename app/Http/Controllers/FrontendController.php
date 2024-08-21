<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\course;
use App\Models\Topic;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseSubscribe;
use Carbon\Carbon;

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

       // after find course
       

       $user = Auth::user();
            
       // Check if the user is authenticated
       if (!$user) {
           return redirect()->route('login')->with('error', 'Please log in to view the questions.');
       }

       $subscription = CourseSubscribe::where('user_id', $user->id)
       ->where('course_id', $course->id)
       ->where(function ($query) {
           $query->whereNull('expires_at')
               ->orWhere('expires_at', '>=', Carbon::now());
       })
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
    ->select('topics.id as topic_id', 'topics.t_title as topic_name')
    ->where('course_topics.course_id', $course->id)
    ->where('topics.subject_id', $subject->subject_id)
    ->get();

       if (!$topics) {
        abort(404, 'Course not found');
    }




       return view('frontend.course_topic', [
           'course' => $course,
           'subject' => $subject,
           'topics' => $topics,
           'subscription'=>$subscription,
       ]);
   }

   public function showQuestions($course_id,$topic_id)
   {
    $user = Auth::user();
        
    // Check if the user is authenticated
    if (!$user) {
        return redirect()->route('login')->with('error', 'Please log in to view the questions.');
    }

    $subscription = CourseSubscribe::where('user_id', $user->id)
    ->where('course_id', $course_id)
    ->where(function ($query) {
        $query->whereNull('expires_at')
              ->orWhere('expires_at', '>=', Carbon::now());
    })
    ->first();

// If no active subscription, show an error or redirect
    if (!$subscription) {
        return redirect()->route('subscription.error')->with('error', 'Your subscription has expired or does not exist.');
    }

    $questions = Question::where('topic_id', $topic_id)
            ->with('options')
            ->paginate(20); // Show 20 questions per page

     $course = Course::where('id', $course_id)->first();
           
    
       return view('frontend.topic_question', compact('questions','course'));
   }
}
