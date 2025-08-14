<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelTest;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Question;
use App\Models\Import;
use App\Models\ModelTestQuestion;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class ModelTestController extends Controller
{
    public function index()
    {
        $modelTests = ModelTest::all();
        return view('backend.model_tests.index', compact('modelTests'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('backend.model_tests.create',compact('courses'));
    }

    public function store(Request $request)
    {


        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:model_tests',
            'course_id' => 'required|exists:courses,id',
            'status' => 'required|integer',
            'm_description' => 'required',
            'mark' => 'required|string|max:255',
            'set_time' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
       

        ModelTest::create($request->all());

        return redirect()->route('admin.model_tests.index')
            ->with('success', 'Model Test created successfully.');
    }

    public function show(ModelTest $modelTest)
    {
        return view('backend.model_tests.show', compact('modelTest'));
    }

    public function edit(ModelTest $modelTest)
    {
        $courses = Course::all();
        $modelTest->start_date = Carbon::parse($modelTest->start_date);
        $modelTest->end_date = Carbon::parse($modelTest->end_date);
        return view('backend.model_tests.edit', compact('modelTest','courses'));
    }

    public function update(Request $request, ModelTest $modelTest)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:model_tests,slug,' . $modelTest->id,
            'course_id' => 'required|exists:courses,id',
            'm_description' => 'required',
            'mark' => 'required|string|max:255',
            'status' => 'required|integer',
            'set_time' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $modelTest->update($request->all());

        return redirect()->route('admin.model_tests.index')
            ->with('success', 'Model Test updated successfully.');
    }

    public function destroy(ModelTest $modelTest)
    {
        $modelTest->delete();

        return redirect()->route('admin.model_tests.index')
            ->with('success', 'Model Test deleted successfully.');
    }

    public function showAddQuestionsForm($modelTestId)
    {
        $modelTest = ModelTest::findOrFail($modelTestId);
        $subjects = Subject::all(); // Get all subjects

        $questionCount = ModelTestQuestion::where('model_test_id', $modelTestId)->count();

            //subjects question
        $results = DB::table('subjects')
        ->join('model_test_questions', 'subjects.id', '=', 'model_test_questions.subject_id')
        ->join('questions', 'model_test_questions.question_id', '=', 'questions.id')
        ->select('subjects.s_title', DB::raw('COUNT(questions.id) as question_count'))
        ->where('model_test_questions.model_test_id', $modelTestId) // Use $modelTestId here
        ->groupBy('subjects.s_title')
        ->get();

        $topicscouts = DB::table('topics')
        ->join('model_test_questions', 'topics.id', '=', 'model_test_questions.topic_id')
        ->join('questions', 'model_test_questions.question_id', '=', 'questions.id')
        ->select('topics.t_title', DB::raw('COUNT(questions.id) as question_count'))
        ->where('model_test_questions.model_test_id', $modelTestId) // Assuming model_test_id is an integer
        ->groupBy('topics.t_title')
        ->get();




        return view('backend.model_tests.generate.add-questions', compact('modelTest', 'subjects','questionCount','results','topicscouts'));
    }



    public function showAddQuestionsFormcustom($modelTestId)
    {
        $modelTest = ModelTest::findOrFail($modelTestId);
        $subjects = Subject::all(); // Get all subjects

        $questionCount = ModelTestQuestion::where('model_test_id', $modelTestId)->count();

            //subjects question
        $results = DB::table('subjects')
        ->join('model_test_questions', 'subjects.id', '=', 'model_test_questions.subject_id')
        ->join('questions', 'model_test_questions.question_id', '=', 'questions.id')
        ->select('subjects.s_title', DB::raw('COUNT(questions.id) as question_count'))
        ->where('model_test_questions.model_test_id', $modelTestId) // Use $modelTestId here
        ->groupBy('subjects.s_title')
        ->get();

        $topicscouts = DB::table('topics')
        ->join('model_test_questions', 'topics.id', '=', 'model_test_questions.topic_id')
        ->join('questions', 'model_test_questions.question_id', '=', 'questions.id')
        ->select('topics.t_title', DB::raw('COUNT(questions.id) as question_count'))
        ->where('model_test_questions.model_test_id', $modelTestId) // Assuming model_test_id is an integer
        ->groupBy('topics.t_title')
        ->get();


        $levels = Import::all();

        return view('backend.model_tests.generate.add-questions-custom', compact('modelTest', 'subjects','questionCount','results','topicscouts','levels'));
    }
    public function getQuestionsByLevel($import_id)
        {
            $questions = Question::where('import_id', $import_id)->get();
            return response()->json(['questions' => $questions]);
        }





    /**
     * Add questions to a model test.
     */
    public function addQuestions(Request $request)
    {


        $request->validate([
            'model_test_id' => 'required|exists:model_tests,id',
            'subject_id' => 'required|exists:subjects,id',
            'topic_id' => 'required|exists:topics,id',
            'question_ids' => 'required|array',
            'question_ids.*' => 'exists:questions,id',
        ]);

        // Loop through each question ID and create a new record in the model_test_questions table
        foreach ($request->question_ids as $questionId) {
            ModelTestQuestion::create([
                'model_test_id' => $request->model_test_id,
                'subject_id' => $request->subject_id,
                'topic_id' => $request->topic_id,
                'question_id' => $questionId,
            ]);
        }

        return redirect()->back()->with('success', 'Questions added to model test successfully.');
    }


    public function addQuestionscustom(Request $request)
    {


        

        $request->validate([
            'model_test_id' => 'required|exists:model_tests,id',
            
            'question_ids' => 'required|array',
            'question_ids.*' => 'exists:questions,id',
        ]);

       $modelTest = ModelTest::findOrFail($request->model_test_id);

        foreach ($request->question_ids as $qid) {
        $question = Question::find($qid);

        ModelTestQuestion::create([
        'model_test_id' => $modelTest->id,
        'question_id' => $question->id,
        'subject_id' => $question->subject_id ?? 0,
        'topic_id' => $question->topic_id ?? 0,
        ]);
        }

       

        return redirect()->back()->with('success', 'Questions added to model test successfully.');
    }
    

   


   public function editAll($id)
   {
   
        $modelTest = modelTest::findOrFail($id);
       
       return view('backend.model_tests.edit_all',compact('modelTest'));
   }

   // Update the start date for all videos by adding the number of days
   public function updateAll(Request $request)
   {
       // Validate the input
      // Request থেকে start_date নিন
    $start_date = Carbon::parse($request->input('start_date'));
    $end_date = Carbon::parse($request->input('end_date'));

    // সমস্ত ভিডিও আপডেট করার জন্য loop চালান
    $start_id = $request->input('modeltest_number');
  

    // মডেল টেস্ট গেট করার জন্য, start_id থেকে পরবর্তী আইডি গুলোর মডেল টেস্ট গেট করুন
    $modelTests = modelTest::where('status', 1)
    ->where('id', '>=', $start_id)
    ->get();
   
    foreach ($modelTests as $index => $modelTest) {
        // সিরিয়াল হিসেবে তারিখ পরিবর্তন করুন
        $modelTest->start_date = $start_date->copy()->addDays($index);
        $modelTest->end_date = $end_date->copy()->addDays($index);
        $modelTest->save();
    }

    // সফলভাবে আপডেট হওয়ার পর রিডিরেক্ট বা মেসেজ দিন
    return redirect()->route('admin.model_tests.index')->with('success', 'All video start dates have been updated.');
   }


}
