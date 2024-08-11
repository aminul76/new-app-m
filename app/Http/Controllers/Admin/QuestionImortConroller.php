<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToArray;
use Illuminate\Support\Str;

use App\Models\Question;
use App\Models\Option;
use App\Models\Subject;
use App\Models\QuestionYear;
use App\Models\ExamQuestion;
use App\Models\ExamQuestionYear;
use App\Models\Year;
use App\Models\Exam;
Use App\Models\Import;
use Illuminate\Http\Request;

class QuestionImortConroller extends Controller
{
    public function YearExamIndex()
    {
        $subjects = Subject::all();
        $years = Year::all();
        $exams = Exam::all();
        return view('backend.import.questions.year_exam_index',compact('subjects','years','exams'));
    }

    public function YearExam(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv',
            'subject_id' => 'required|exists:subjects,id', // Validate subject_id
            'year_id' => 'required|exists:years,id',
            'exam_id' => 'required|exists:exams,id',
            'i_title' => 'required|string|max:255',
        ]);


        $file = $request->file('file');
        $rows = Excel::toArray([], $file);
        $rowCount = 0;
        $question = null;

        $import=Import::create([
            'i_title' => $request->i_title,
            'i_slug' => Str::slug($request->i_slug),
        ]);


        if ($import){
        foreach ($rows[0] as $row) {
            // Skip blank rows
            if (empty(array_filter($row))) {
                continue;
            }

            // Ensure that row has at least one value for question and two values for options
            if (count($row) < 1) {
                continue; // Skip rows with insufficient data
            }

            if ($rowCount % 5 == 0) {
                // Create a new question
                $question = Question::create([
                    'q_title' => $row[0], // Assuming question title is in the first column
                    'subject_id' => $request->subject_id,
                    'q_slug' => Str::slug($row[0]), // Generate slug from title
                    'import_id' => $import->id,
                ]);

                if ($question && isset($row[0])) {
                    QuestionYear::create([
                        'question_id' => $question->id,
                        'year_id' => $request->year_id,
                    ]);
                }

                if ($question && isset($row[0])) {
                    ExamQuestion::create([
                        'question_id' => $question->id,
                        'exam_id' => $request->exam_id,
                    ]);
                }

                if ($question && isset($row[0])) {
                    ExamQuestionYear::create([
                        'question_id' => $question->id,
                        'exam_id' => $request->exam_id,
                       'year_id' => $request->year_id,
                    ]);
                }
            } else {
                // Ensure the row has enough data for options
                if ($question && isset($row[0])) {
                    Option::create([
                        'question_id' => $question->id,
                        'p_title' => $row[0], // Assuming option title is in the first column
                        'is_correct' => $row[1] ?? 0, // Assuming correctness is in the second column, default to 0
                    ]);
                }
            }

            $rowCount++;
        }

        return redirect()->back()->with('success', 'Questions and options imported successfully.');
        }

    }

    public function explanExamIndex()
    {
        $subjects = Subject::all();
        $years = Year::all();
        $exams = Exam::all();
        return view('backend.import.questions.explan_exam_index',compact('subjects','years','exams'));
    }

    public function explanExam(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv',
            'subject_id' => 'required|exists:subjects,id', // Validate subject_id
            'year_id' => 'required|exists:years,id',
            'exam_id' => 'required|exists:exams,id',
            'i_title' => 'required|string|max:255',
        ]);

        $file = $request->file('file');
        $rows = Excel::toArray([], $file);
        $rowCount = 0;
        $question = null;

        $import = Import::create([
            'i_title' => $request->i_title,
            'i_slug' => Str::slug($request->i_title),
        ]);

        if ($import) {
            foreach ($rows[0] as $row) {
                // Skip blank rows
                if (empty(array_filter($row))) {
                    continue;
                }

                if ($rowCount % 6 == 0 && isset($row[0])) {
                    // Create a new question
                    $question = Question::create([
                        'q_title' => $row[0], // Question title
                        'subject_id' => $request->subject_id,
                        'q_slug' => Str::slug($row[0]), // Generate slug from title
                        'import_id' => $import->id,
                    ]);

                    if ($question) {
                        QuestionYear::create([
                            'question_id' => $question->id,
                            'year_id' => $request->year_id,
                        ]);

                        ExamQuestion::create([
                            'question_id' => $question->id,
                            'exam_id' => $request->exam_id,
                        ]);

                        ExamQuestionYear::create([
                            'question_id' => $question->id,
                            'exam_id' => $request->exam_id,
                            'year_id' => $request->year_id,
                        ]);
                    }
                } else if ($rowCount % 6 == 5 && isset($row[0])) {
                    // 6th row - update the question with explanation
                    $question->update([
                        'q_explain' => $row[0], // Explanation/description
                    ]);
                } else {
                    // Rows 2, 3, 4, 5 - Options
                    if ($question && isset($row[0])) {
                        Option::create([
                            'question_id' => $question->id,
                            'p_title' => $row[0], // Option title
                            'is_correct' => $row[1] ?? 0, // Correctness of the option, default to 0
                        ]);
                    }
                }

                $rowCount++;
            }

            return redirect()->back()->with('success', 'Questions and options imported successfully.');
        }
    }


}
