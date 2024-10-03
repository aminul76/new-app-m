<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\User;
use App\Models\UserExamRecord;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function profile($course_slug){

        $user = Auth::user();

        $course = Course::where('c_slug', $course_slug)->first();

        if (!$user) {
            return view('frontend.course', ['course' => $course,]);
        }
        
        $totalCorrectAnswers = UserExamRecord::where('user_id', $user->id)
        ->sum('correct_answers_count');
        $totalinCorrectAnswers = UserExamRecord::where('user_id', $user->id)
        ->sum('incorrect_answers_count');

        $totalmarks = UserExamRecord::where('user_id', $user->id)
        ->sum('modeltest_count');

        if (!$totalCorrectAnswers) {
            $correct=0;
        }
        else {
            $correct=($totalCorrectAnswers*100)/$totalmarks;
        }
       

        if (!$totalCorrectAnswers) {
            $incorrect=0;
        }
        else {
            $incorrect=($totalinCorrectAnswers*100)/$totalmarks;

        }

       
        return view('user.profile.index',compact('course','correct',
        'incorrect','totalmarks','totalCorrectAnswers','totalinCorrectAnswers','user'));
    }

  


}
