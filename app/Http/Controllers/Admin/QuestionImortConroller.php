<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToArray;
use App\Models\Question;
use App\Models\Option;
use App\Models\Subject;
use App\Models\QuestionYear;
use App\Models\ExamQuestion;
use App\Models\ExamQuestionYear;
use App\Models\Year;
use App\Models\Exam;
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
        ]);

        $file = $request->file('file');
        $rows = Excel::toArray([], $file);
        $rowCount = 0;
        $question = null;

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
