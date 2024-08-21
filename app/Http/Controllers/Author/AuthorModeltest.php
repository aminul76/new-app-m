<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ModelTest;
use App\Models\Course;
use App\Helpers\DateHelper;
use App\Models\Question;
use App\Models\Option;
use App\Models\UserModelAnswer;
use App\Models\UserExamRecord;
use App\Models\Answer;
use Illuminate\Http\Request;
use Carbon\Carbon;




class AuthorModeltest extends Controller
{
    public function current($courseSlug)
    {
        $user = Auth::user();
        
        // Check if the user is authenticated
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to view the questions.');
        }

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
            ->get();
      
          
        return view('user.modeltest.current', compact('modelTests','course','dateBangla'));
    }
    public function dateModelTest($courseSlug, $date)
    {
     
     

     
        // Find the course by slug
        $course = Course::where('c_slug', $courseSlug)->firstOrFail();
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

    function examModel($course_slug,$modeltest_id) {

        $course = Course::where('c_slug', $course_slug)->first();
        $modelTest = ModelTest::with('questions.question.options')->findOrFail($modeltest_id);
        




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

return view('user.modeltest.allreadyresults', [
'modelTest' => $modelTest,
'userAnswers' => $userAnswers,
'correctAnswers' => $correctAnswers,
'course' => $course
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
    
        $course = Course::where('c_slug', $course_slug)->first();

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
    
        return view('user.modeltest.results', [
            'modelTest' => $modelTest,
            'userAnswers' => $userAnswers,
            'correctAnswers' => $correctAnswers,
            'course'=>$course
        ]);
    }
    
}
