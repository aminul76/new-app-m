<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Import;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class ImportLabalController extends Controller
{
    public function LabelIndex()
    {
        $labels=Import::all();
        return view('backend.import.label.index', compact('labels'));
    }

    public function labeldestroy($id)
    {
        // Find the import label by ID and delete it
        $import = Import::findOrFail($id);
        $import->delete();

        // Redirect to a route that exists
        return redirect()->route('admin.label.index')->with('success', 'Import label deleted successfully.');
    }




        public function LabelSubject($id)
        {
            $subjects=Subject::all();

            $subject = Subject::find($id);

            // $questions = DB::table('questions')
            // ->join('options', 'options.question_id', '=', 'questions.id')
            // ->join('imports', 'imports.id', '=', 'questions.import_id')
            // ->join('subjects', 'subjects.id', '=', 'questions.subject_id')
            // ->join('topics', 'subjects.id', '=', 'topics.subject_id')
            // ->select('questions.q_title','options.p_title')

            // ->get();

            // $questions = DB::table('questions')
            // ->join('options', 'options.question_id', '=', 'questions.id')
            // ->join('imports', 'imports.id', '=', 'questions.import_id')
            // ->join('subjects', 'subjects.id', '=', 'questions.subject_id')
            // ->join('topics', 'topics.subject_id', '=', 'subjects.id') // Corrected join condition
            // ->select('questions.id as question_id', 'questions.q_title', 'options.p_title', 'topics.id as topic_id', 'topics.t_title')
            // ->where('questions.import_id', $id)
            // ->get();



            $questions = DB::table('questions')
            ->join('options', 'options.question_id', '=', 'questions.id')
            ->select('questions.id as question_id','questions.topic_id', 'questions.q_title','questions.subject_id', 'options.p_title','options.is_correct')
            ->where('questions.import_id', $id)
            ->get();

            $firstQuestionSubjectId = null;
            if ($questions->isNotEmpty()) {
                $firstQuestion = $questions->first();
                $firstQuestionSubjectId = $firstQuestion->subject_id;
            }

            $questiontopicstats=Question::where('import_id',$id)->first();

             if($questiontopicstats->topic_id !=null){
                $topicStatus=1;
             }
             else{
                $topicStatus=0;
             }


        $topics = DB::table('topics')->where('subject_id',$firstQuestionSubjectId)->get(); // Fetch topics for the dropdown


            // Fetch questions and options using joins
            // $questions = DB::table('questions')
            //     ->join('options', 'questions.id', '=', 'options.question_id')
            //     ->select('questions.id as question_id', 'questions.q_title as question_text',
            //              'options.id as option_id', 'options.p_title as option_text')
            //     ->where('questions.subject_id', $subject_id)
            //     ->get()
            //     ->groupBy('question_id');


            return view('backend.import.label.subject', compact('subjects','id','questions','topics','topicStatus'));
        }

        public function LabelSubjectTopic(Request $request){

            $questions=Question::where('import_id',$id);

            $topic = Topic::find($request->subject_id);
            $label = Import::with('questions.options')->find($request->id);
            return view('backend.import.label.subjecttopic', compact('label','topic'));
        }


        public function storeTopics(Request $request)
        {
            // Validate the request to ensure topics are selected
            $validatedData = $request->validate([
                'topics' => 'required|array',
                'topics.*' => 'required|exists:topics,id',
            ]);

            
            foreach ($validatedData['topics'] as $questionId => $topicId) {
                // Find the question by ID and update the topic_id
                $question = Question::find($questionId);

                if ($question) {
                    // Update the topic_id field of the question
                    $question->topic_id = $topicId;
                    $question->save();
                }
            }

            return redirect()->back()->with('success', 'Topics updated successfully.');
        }

}
