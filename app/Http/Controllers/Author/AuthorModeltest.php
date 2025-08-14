<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ModelTest;
use App\Models\Course;
use App\Helpers\DateHelper;
use App\Models\Question;
use App\Models\Option;
use App\Models\UserModelAnswer;
use App\Models\UserExamRecord;
use App\Models\Answer;
use App\Models\Video;
use App\Models\CourseSubscribe;
use Illuminate\Http\Request;
use Carbon\Carbon;




class AuthorModeltest extends Controller
{
    public function current($courseSlug)
    {
        $user = Auth::user();
        
        // Check if the user is authenticated
    
        $course = Course::where('c_slug', $courseSlug)->first();

      

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
            ->where('status',1)
            ->get();
      
          
        return view('user.modeltest.current', compact('modelTests','course','dateBangla'));
    }

    public function videocurrent($courseSlug)
    {
        $user = Auth::user();
        
        // Check if the user is authenticated
    
        $course = Course::where('c_slug', $courseSlug)->first();

      

        $currentDate = Carbon::now();
       
        $date = \Carbon\Carbon::parse($currentDate);

        $formattedDate = $currentDate->format('j F Y'); // English format
        $formattedDate = DateHelper::toBengaliNumerals($formattedDate);
        $month = $currentDate->format('F');

        $dateBangla = str_replace($month, DateHelper::toBengaliMonth($month), $formattedDate);

        $formattedDate = $currentDate->format('j F Y'); // English format
        $videos = Video::where('course_id', $course->id)
            ->whereDate('start_date', '<=', $date)
            ->whereDate('end_date', '>=', $date)
            ->where('status',1)
            ->get();
        
          
        return view('user.videos.current', compact('videos','course','dateBangla'));
    }

    public function dateModelTest($courseSlug, $date)
    {
     
     
   
        $user = Auth::user();
        
        // Check if the user is authenticated
    

     
     
        // Find the course by slug
        $course = Course::where('c_slug', $courseSlug)->firstOrFail();

        if (!$user) {
            return view('user.profile.index', ['course' => $course,]);
        }

        
        $subscription = CourseSubscribe::where('user_id', $user->id)
        ->where('course_id', $course->id)
        ->where(function ($query) {
            $query->whereNull('expires_at')
                  ->orWhere('expires_at', '>=', Carbon::now());
        })
        ->first();
    
    // If no active subscription, show an error or redirect
        if (!$subscription) {
            return view('user.subcribe.subcribe', ['course' => $course,]);
        }


        $date = \Carbon\Carbon::parse($date);
        // Fetch model tests for the given course and date
        // Assuming we want tests that overlap with the given date
        $modelTests = ModelTest::where('course_id', $course->id)
            ->whereDate('start_date', '<=', $date)
            ->whereDate('end_date', '>=', $date)
            ->get();

        // Pass the course, date, and model tests to the view
       
        $formattedDate = $date->format('j F Y'); // English format
        $formattedDate = DateHelper::toBengaliNumerals($formattedDate);
        $month = $date->format('F');
        $dateBangla = str_replace($month, DateHelper::toBengaliMonth($month), $formattedDate);


        $currentDate = \Carbon\Carbon::now()->startOfDay();
        
        if ($date->isSameDay($currentDate)) {
            return view('user.modeltest.current', compact('modelTests', 'course', 'dateBangla'));
        }
    
        return view('user.modeltest.datemodel', [
            'course' => $course,
            'date' => $date,
            'modelTests' => $modelTests,
            'dateBangla'=>$dateBangla,
        ]);
    }


    public function datevideo($courseSlug, $date)
    {
     
     
   
        $user = Auth::user();
        
        // Check if the user is authenticated
    

     
     
        // Find the course by slug
        $course = Course::where('c_slug', $courseSlug)->firstOrFail();

        if (!$user) {
            return view('user.profile.index', ['course' => $course,]);
        }

        
        $subscription = CourseSubscribe::where('user_id', $user->id)
        ->where('course_id', $course->id)
        ->where(function ($query) {
            $query->whereNull('expires_at')
                  ->orWhere('expires_at', '>=', Carbon::now());
        })
        ->first();
    
    // If no active subscription, show an error or redirect
        if (!$subscription) {
            return view('user.subcribe.subcribe', ['course' => $course,]);
        }


        $date = \Carbon\Carbon::parse($date);
        // Fetch model tests for the given course and date
        // Assuming we want tests that overlap with the given date
        $videos = Video::where('course_id', $course->id)
            ->whereDate('start_date', '<=', $date)
            ->whereDate('end_date', '>=', $date)
            ->get();

        // Pass the course, date, and model tests to the view
       
        $formattedDate = $date->format('j F Y'); // English format
        $formattedDate = DateHelper::toBengaliNumerals($formattedDate);
        $month = $date->format('F');
        $dateBangla = str_replace($month, DateHelper::toBengaliMonth($month), $formattedDate);


        $currentDate = \Carbon\Carbon::now()->startOfDay();
       

            if ($date->isBefore($currentDate)) {
                // পূর্বের (আগের) দিন
                return view('user.videos.current', compact('videos', 'course', 'dateBangla'));
            } elseif ($date->isSameDay($currentDate)) {
                // আজকের দিন
                return view('user.videos.current', compact('videos', 'course', 'dateBangla'));
            } elseif ($date->isAfter($currentDate)) {
                // পরবর্তী দিন
                return view('user.videos.datemodel', [
                    'course' => $course,
                    'date' => $date,
                    'videos' => $videos,
                    'dateBangla'=>$dateBangla,
                ]);
            }
                
        
    }



    function examModel($course_slug,$modeltest_id) {

        $course = Course::where('c_slug', $course_slug)->first();

        $user = Auth::user();
        
        // Check if the user is authenticated
         if (!$user) {
            return view('frontend.course', ['course' => $course,]);
        }

        $modelTest = ModelTest::with('questions.question.options')->findOrFail($modeltest_id);
        


       
    
        $subscription = CourseSubscribe::where('user_id', $user->id)
        ->where('course_id', $course->id)
        ->where(function ($query) {
            $query->whereNull('expires_at')
                  ->orWhere('expires_at', '>=', Carbon::now());
        })
        ->first();
    
            // If no active subscription, show an error or redirect
        if (!$subscription) {
            return view('user.subcribe.subcribe', ['course' => $course,]);
        }

            //end subcribe

         // Check if the user has already submitted answers for this test
        $userAnswers = Answer::where('user_id', auth()->id())
        ->where('modeltest_id', $modeltest_id)
        ->pluck('selected_option_id', 'question_id')
        ->toArray();

        // If user has already submitted answers, redirect to results page
        if (!empty($userAnswers)) {
        $correctAnswers = [];
        foreach ($modelTest->modelTestQuestions as $modelTestQuestion) {
        $correctOption = $modelTestQuestion->question->options->where('is_correct', true)->first();
        if ($correctOption) {
        $correctAnswers[$modelTestQuestion->question->id] = $correctOption->p_title;
        }
        }

        $subjects = DB::table('answers')
            ->select('subjects.s_title as subject_name', DB::raw('
                SUM(CASE WHEN options.is_correct = 1 THEN 1 ELSE 0 END) AS right_answers,
                SUM(CASE WHEN options.is_correct = 0 THEN 1 ELSE 0 END) AS wrong_answers
            '))
            ->join('options', 'answers.selected_option_id', '=', 'options.id')
            ->join('subjects', 'answers.subject_id', '=', 'subjects.id')
            ->where('answers.modeltest_id', $modeltest_id)
            ->where('user_id', auth()->id())
            ->groupBy('subjects.id', 'subjects.s_title')
            ->get();

        // Fetch model test name or other details if needed
        //$modeltest = DB::table('model_tests')->where('id', $modeltest_id)->first();
        $totals = DB::table('answers')
        ->select(DB::raw('
            SUM(CASE WHEN options.is_correct = 1 THEN 1 ELSE 0 END) AS total_right_answers,
            SUM(CASE WHEN options.is_correct = 0 THEN 1 ELSE 0 END) AS total_wrong_answers,
            COUNT(DISTINCT answers.user_id) AS total_users
        '))
        ->join('options', 'answers.selected_option_id', '=', 'options.id')
        ->where('answers.modeltest_id', $modeltest_id)
        ->where('user_id', auth()->id())
        ->first();

        $answertab=Answer::where('modeltest_id', $modeltest_id)
        ->first();
        $currentDate = $answertab->created_at;
       
        $date = \Carbon\Carbon::parse($currentDate);

        $formattedDate = $currentDate->format('j F Y'); // English format
        $formattedDate = DateHelper::toBengaliNumerals($formattedDate);
        $month = $currentDate->format('F');

        $dateBangla = str_replace($month, DateHelper::toBengaliMonth($month), $formattedDate);


        return view('user.modeltest.allreadyresults', [
        'modelTest' => $modelTest,
        'userAnswers' => $userAnswers,
        'correctAnswers' => $correctAnswers,
        'course' => $course,
        'subjects' => $subjects,
        'totals'=>$totals,
        'dateBangla'=> $dateBangla
        ]);
    }





        return view('user.modeltest.exam', compact('modelTest','course','course_slug'));
    }





    function resultlist($course_slug,$modeltest_id) {

        $course = Course::where('c_slug', $course_slug)->first();

        $user = Auth::user();
        
        // Check if the user is authenticated
         if (!$user) {
            return view('frontend.course', ['course' => $course,]);
        }

        $modelTest = ModelTest::with('questions.question.options')->findOrFail($modeltest_id);
        


       
    
        $subscription = CourseSubscribe::where('user_id', $user->id)
        ->where('course_id', $course->id)
        ->where(function ($query) {
            $query->whereNull('expires_at')
                  ->orWhere('expires_at', '>=', Carbon::now());
        })
        ->first();
    
            // If no active subscription, show an error or redirect
        if (!$subscription) {
            return view('user.subcribe.subcribe', ['course' => $course,]);
        }

            //end subcribe

         // Check if the user has already submitted answers for this test
        $userAnswers = Answer::where('user_id', auth()->id())
        ->where('modeltest_id', $modeltest_id)
        ->pluck('selected_option_id', 'question_id')
        ->toArray();

        // If user has already submitted answers, redirect to results page
        if (!empty($userAnswers)) {
        $correctAnswers = [];
        foreach ($modelTest->modelTestQuestions as $modelTestQuestion) {
        $correctOption = $modelTestQuestion->question->options->where('is_correct', true)->first();
        if ($correctOption) {
        $correctAnswers[$modelTestQuestion->question->id] = $correctOption->p_title;
        }
        }

        $subjects = DB::table('answers')
            ->select('subjects.s_title as subject_name', DB::raw('
                SUM(CASE WHEN options.is_correct = 1 THEN 1 ELSE 0 END) AS right_answers,
                SUM(CASE WHEN options.is_correct = 0 THEN 1 ELSE 0 END) AS wrong_answers
            '))
            ->join('options', 'answers.selected_option_id', '=', 'options.id')
            ->join('subjects', 'answers.subject_id', '=', 'subjects.id')
            ->where('answers.modeltest_id', $modeltest_id)
            ->where('user_id', auth()->id())
            ->groupBy('subjects.id', 'subjects.s_title')
            ->get();

        // Fetch model test name or other details if needed
        //$modeltest = DB::table('model_tests')->where('id', $modeltest_id)->first();
        $totals = DB::table('answers')
        ->select(DB::raw('
            SUM(CASE WHEN options.is_correct = 1 THEN 1 ELSE 0 END) AS total_right_answers,
            SUM(CASE WHEN options.is_correct = 0 THEN 1 ELSE 0 END) AS total_wrong_answers,
            COUNT(DISTINCT answers.user_id) AS total_users
        '))
        ->join('options', 'answers.selected_option_id', '=', 'options.id')
        ->where('answers.modeltest_id', $modeltest_id)
        ->where('user_id', auth()->id())
        ->first();

        $answertab=Answer::where('modeltest_id', $modeltest_id)
        ->first();
        $currentDate = $answertab->created_at;
       
        $date = \Carbon\Carbon::parse($currentDate);

        $formattedDate = $currentDate->format('j F Y'); // English format
        $formattedDate = DateHelper::toBengaliNumerals($formattedDate);
        $month = $currentDate->format('F');

        $dateBangla = str_replace($month, DateHelper::toBengaliMonth($month), $formattedDate);


        return view('user.modeltest.allreadyresults', [
        'modelTest' => $modelTest,
        'userAnswers' => $userAnswers,
        'correctAnswers' => $correctAnswers,
        'course' => $course,
        'subjects' => $subjects,
        'totals'=>$totals,
        'dateBangla'=> $dateBangla
        ]);
    }





        return view('user.modeltest.exam', compact('modelTest','course','course_slug'));
    }




    // public function submitExam(Request $request, $course_slug, $modeltest_id)
    // {
    //     $validated = $request->validate([
    //         'answers' => 'required|array',
    //         'answers.*' => 'exists:options,id'
    //     ]);
    
    //     // Fetch the model test and related questions
    //     $modelTest = ModelTest::with('modelTestQuestions.question.options')->findOrFail($modeltest_id);
    //     $userAnswers = $request->input('answers');
        
        
    //     // Delete previous answers if they exist
    //     Answer::where('user_id', auth()->id())
    //               ->where('modeltest_id', $modeltest_id)
                  
    //               ->delete();
    
    //     // Save new answers
    //     foreach ($userAnswers as $questionId => $optionId) {
    //         $question = Question::findOrFail($questionId);
            
    //         Answer::create([
    //             'user_id' => auth()->id(),
    //             'modeltest_id' => $modeltest_id,
    //             'question_id' => $questionId,
    //             'selected_option_id' => $optionId,
    //             'subject_id' => $question->subject_id,
    //         ]);
    //     }
    


    //     $correctAnswers = [];
    //     foreach ($modelTest->modelTestQuestions as $modelTestQuestion) {
    //         $correctOption = $modelTestQuestion->question->options->where('is_correct', true)->first();
    //         if ($correctOption) {
    //             $correctAnswers[$modelTestQuestion->question->id] = $correctOption->p_title;
    //         }
    //     }
    
    //     return view('user.modeltest.results', [
    //         'modelTest' => $modelTest,
    //         'userAnswers' => $userAnswers,
    //         'correctAnswers' => $correctAnswers
    //     ]);
    // }
    public function submitExam(Request $request, $course_slug, $modeltest_id)
    {
        // রিকোয়েস্ট ভ্যালিডেশন
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'exists:options,id'
        ]);
    
        $user = Auth::user();
        $course = Course::where('c_slug', $course_slug)->first();

        if (!$user) {
            return view('frontend.course', ['course' => $course,]);
        }

        // মডেল টেস্ট এবং সম্পর্কিত প্রশ্নগুলি আনুন
        $modelTest = ModelTest::with('modelTestQuestions.question.options')->findOrFail($modeltest_id);
        $userAnswers = $request->input('answers');
        
        // পুরানো উত্তর মুছে ফেলুন যদি আগে থেকে থাকে
        Answer::where('user_id', auth()->id())
              ->where('modeltest_id', $modeltest_id)
              ->delete();
    
        // নতুন উত্তর সংরক্ষণ করুন
        foreach ($userAnswers as $questionId => $optionId) {
            $question = Question::findOrFail($questionId);
            
            Answer::create([
                'user_id' => auth()->id(),
                'modeltest_id' => $modeltest_id,
                'question_id' => $questionId,
                'selected_option_id' => $optionId,
                'subject_id' => $question->subject_id,
            ]);
        }
    
        // সঠিক এবং ভুল উত্তরের সংখ্যা হিসাব করুন
        $correctAnswerCount = 0;
        $incorrectAnswerCount = 0;
    
        foreach ($userAnswers as $questionId => $selectedOptionId) {
            $question = Question::with('options')->findOrFail($questionId);
            $correctOption = $question->options->where('is_correct', true)->first();
    
            if ($correctOption) {
                if ($selectedOptionId == $correctOption->id) {
                    $correctAnswerCount++;
                } else {
                    $incorrectAnswerCount++;
                }
            }
        }
    
        // পারফরম্যান্স মেট্রিক্স সংরক্ষণ করুন
        UserExamRecord::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'modeltest_id' => $modeltest_id,
            ],
            [
                'correct_answers_count' => $correctAnswerCount,
                'incorrect_answers_count' => $incorrectAnswerCount,
                'modeltest_count' => $modelTest->mark,
            ]
        );
    
        // সঠিক উত্তরের জন্য ডেটা প্রস্তুত করুন
        $correctAnswers = [];
        foreach ($modelTest->modelTestQuestions as $modelTestQuestion) {
            $correctOption = $modelTestQuestion->question->options->where('is_correct', true)->first();
            if ($correctOption) {
                $correctAnswers[$modelTestQuestion->question->id] = $correctOption->p_title;
            }
        }


        $subjects = DB::table('answers')
            ->select('subjects.s_title as subject_name', DB::raw('
                SUM(CASE WHEN options.is_correct = 1 THEN 1 ELSE 0 END) AS right_answers,
                SUM(CASE WHEN options.is_correct = 0 THEN 1 ELSE 0 END) AS wrong_answers
            '))
            ->join('options', 'answers.selected_option_id', '=', 'options.id')
            ->join('subjects', 'answers.subject_id', '=', 'subjects.id')
            ->where('answers.modeltest_id', $modeltest_id)
            ->where('user_id', auth()->id())
            ->groupBy('subjects.id', 'subjects.s_title')
            ->get();

        // Fetch model test name or other details if needed
        //$modeltest = DB::table('model_tests')->where('id', $modeltest_id)->first();
        $totals = DB::table('answers')
        ->select(DB::raw('
            SUM(CASE WHEN options.is_correct = 1 THEN 1 ELSE 0 END) AS total_right_answers,
            SUM(CASE WHEN options.is_correct = 0 THEN 1 ELSE 0 END) AS total_wrong_answers,
            COUNT(DISTINCT answers.user_id) AS total_users
        '))
        ->join('options', 'answers.selected_option_id', '=', 'options.id')
        ->where('answers.modeltest_id', $modeltest_id)
        ->where('user_id', auth()->id())
        ->first();

        $answertab=Answer::where('modeltest_id', $modeltest_id)
        ->first();
        $currentDate = $answertab->created_at;
       
        $date = \Carbon\Carbon::parse($currentDate);

        $formattedDate = $currentDate->format('j F Y'); // English format
        $formattedDate = DateHelper::toBengaliNumerals($formattedDate);
        $month = $currentDate->format('F');

        $dateBangla = str_replace($month, DateHelper::toBengaliMonth($month), $formattedDate);
    
        return view('user.modeltest.results', [
            'modelTest' => $modelTest,
            'userAnswers' => $userAnswers,
            'correctAnswers' => $correctAnswers,
            'course'=>$course,
            'subjects' => $subjects,
            'totals'=>$totals,
            'dateBangla'=> $dateBangla
        ]);
    }

    public function showMarksheet($modeltestId)
    {
        // Fetch data for the specific model test
        $subjects = DB::table('answers')
            ->select('subjects.s_title as subject_name', DB::raw('
                SUM(CASE WHEN options.is_correct = 1 THEN 1 ELSE 0 END) AS right_answers,
                SUM(CASE WHEN options.is_correct = 0 THEN 1 ELSE 0 END) AS wrong_answers
            '))
            ->join('options', 'answers.selected_option_id', '=', 'options.id')
            ->join('subjects', 'answers.subject_id', '=', 'subjects.id')
            ->where('answers.modeltest_id', $modeltestId)
            ->groupBy('subjects.id', 'subjects.s_title')
            ->get();


           

        // Fetch model test name or other details if needed
        $modeltest = DB::table('model_tests')->where('id', $modeltestId)->first();

        $totals = DB::table('answers')
        ->select(DB::raw('
            SUM(CASE WHEN options.is_correct = 1 THEN 1 ELSE 0 END) AS total_right_answers,
            SUM(CASE WHEN options.is_correct = 0 THEN 1 ELSE 0 END) AS total_wrong_answers
        '))
        ->join('options', 'answers.selected_option_id', '=', 'options.id')
        ->where('answers.modeltest_id', $modeltestId)
        ->first();
           
        return view('user.modeltest.markshet', compact('subjects','totals'));
    }




    function examFree($course_slug,$modeltest_id) {

        $course = Course::where('c_slug', $course_slug)->first();
    
        $user = Auth::user();

        if (!$user) {
            return view('user.profile.index', ['course' => $course,]);
        }

        $subscription = CourseSubscribe::where('user_id', $user->id)
        ->where('course_id', $course->id)
        ->where(function ($query) {
            $query->whereNull('expires_at')
                  ->orWhere('expires_at', '>=', Carbon::now());
        })
        ->first();
    
            // If no active subscription, show an error or redirect
        if (!$subscription) {
            return view('user.subcribe.subcribe', ['course' => $course,]);
        }
        
        // Check if the user is authenticated
       
    
        $modelTest = ModelTest::with('questions.question.options')->where('status',2)->findOrFail($modeltest_id);
        
    
    
       
    
    
            //end subcribe
    
         // Check if the user has already submitted answers for this test
        $userAnswers = Answer::where('user_id', auth()->id())
        ->where('modeltest_id', $modeltest_id)
        ->pluck('selected_option_id', 'question_id')
        ->toArray();
    
        // If user has already submitted answers, redirect to results page
       
    
    
    
        return view('user.modeltest.exam', compact('modelTest','course','course_slug'));
    }



    function playvideo($course_slug,$id) {

        $course = Course::where('c_slug', $course_slug)->first();
    
        $user = Auth::user();

        if (!$user) {
            return view('user.profile.index', ['course' => $course,]);
        }

        $subscription = CourseSubscribe::where('user_id', $user->id)
        ->where('course_id', $course->id)
        ->where(function ($query) {
            $query->whereNull('expires_at')
                  ->orWhere('expires_at', '>=', Carbon::now());
        })
        ->first();
    
            // If no active subscription, show an error or redirect
        if (!$subscription) {
            return view('user.subcribe.subcribe', ['course' => $course,]);
        }
        
        // Check if the user is authenticated
       
        $video = Video::where('id',$id)->first();
      
      
    
    
    
        return view('user.videos.play', compact('video','course','course_slug'));
    }
    

    





    
}
