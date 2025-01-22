<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ModelTest;
use App\Models\Course;
use App\Models\Fackuser;
use App\Models\FeckRecoard;
use App\Models\UserExamRecord;
use Carbon\Carbon;
use App\Helpers\DateHelper;

class ResultController extends Controller
{
    public function modelresultlist($course_slug){

           
        $user = Auth::user();
        
        // Check if the user is authenticated
      

        $course = Course::where('c_slug', $course_slug)->first();

        if (!$user) {
           
            return view('user.result.index',compact('course'));
        }


        $currentDate = Carbon::now();
       
        $date = \Carbon\Carbon::parse($currentDate);

        $formattedDate = $currentDate->format('j F Y'); // English format
        $formattedDate = DateHelper::toBengaliNumerals($formattedDate);
        $month = $currentDate->format('F');

        $dateBangla = str_replace($month, DateHelper::toBengaliMonth($month), $formattedDate);

        $formattedDate = $currentDate->format('j F Y'); // English format
        $modelTests = ModelTest::where('course_id', $course->id)
            ->whereDate('start_date', '<=', $date)
            ->whereDate('end_date', '>=', $date)
            ->get();
      
            $exam_records = UserExamRecord::with('modelTest') // Ensure the relationship name is correct
            ->where('user_id', $user->id)
            ->paginate(10);

        return view('user.result.index',compact('course','exam_records'));
        
    }

        public function meritList($course_slug,$modeltest_id){

            $user = Auth::user();
            $course = Course::where('c_slug', $course_slug)->first();

            if (!$user) {
                return view('frontend.course', ['course' => $course,]);
            }

            $userrecord = UserExamRecord::where('modeltest_id', $modeltest_id)
            ->where('user_id', $user->id)
            ->first();
            $allrecords = UserExamRecord::where('modeltest_id', $modeltest_id)->get();

          

            $modelTests = ModelTest::where('id', $modeltest_id)
            ->first();

            $allFackUsers = Fackuser::all();
            $totalMarks = $modelTests->mark; // Set your total marks here

            $allfeckrecoards=FeckRecoard::where('modeltest_id',$modeltest_id)->get();
           
            
//  ফেক রেকর্ড ‍start
            $feckrecoard=FeckRecoard::where('modeltest_id',$modeltest_id)->first();
            if (!$feckrecoard) {
            foreach ($allFackUsers as $user) {
                // Generate a random percentage for correct marks
                $min = $totalMarks * 0.20; // Minimum percentage
                $max = $totalMarks * 0.90; // Maximum percentage
        
                // Generate a random percentage within the defined range
                $formattedMin = number_format($min, 2); // Format as a string with 2 decimal places
                $formattedMax = number_format($max, 2); // Format as a string with 2 decimal places
                $correctPercentage = rand($formattedMin, $formattedMax);
        
                // Calculate the corresponding incorrect percentage
                $incorrectPercentage = $totalMarks - $correctPercentage;
        
                
                // Assign values to the user object
                $user->correctPercentage = $correctPercentage;
                $user->incorrectPercentage = $incorrectPercentage;

                FeckRecoard::create([
                  
                    'fack_user_id'=> $user->id,
                    'modeltest_id'=>$modeltest_id,
                    'correct_answers_count'=> $user->correctPercentage,
                    'incorrect_answers_count'=> $user->incorrectPercentage,
                    
                    // Adjust this based on your Excel structure
                ]);
            }
        }
//  ফেক রেকর্ড end 
           


            return view('user.result.merit',compact('course','userrecord','allrecords','allfeckrecoards','totalMarks'));


            }
}
