<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToArray;
use App\Models\Question;
use App\Models\Option;


class ImportController extends Controller
{
    public function index()
    {
        return view('import.index');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv',
        ]);

        $file = $request->file('file');

        // Read the data from the file
        $rows = Excel::toArray([], $file);

        $rowCount = 0;
        $question = null;

        foreach ($rows[0] as $row) {
            // Skip the header row if present

            if ($rowCount % 5 == 0) {
                // Every 5th row (1, 6, 11, ...) is a new question
                $question = Question::create([
                    'q_title' => $row[0], // Assuming the question title is in the first column
                    // 'q_ans' => $row[1],
                    // Assuming the answer or additional property is in the second column
                    // 'model_tests_id' => $request->modeltest_id,
                    // Set model_tests_id
                ]);
            } else {
                // Rows other than the 5th row are options for the last created question
                if ($question) {
                    Option::create([
                        'question_id' => $question->id,
                        'p_title' => $row[0], // Assuming the option title is in the first column
                       'is_correct' => $row[1] ?? 0,
                    ]);
                }
            }

            $rowCount++;
        }

        return redirect()->back()->with('success', 'Questions and options imported successfully.');
    }

    public function export()
    {
        return Excel::download(new class implements FromCollection, WithHeadingRow {
            public function collection()
            {
                return Question::all();
            }

            public function headings(): array
            {
                return [
                    'subject_id',
                    'topic_id',
                    'q_title',
                    'q_slug',
                    'q_explain',
                ];
            }
        }, 'questions.xlsx');
    }
}
