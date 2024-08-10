<?php
namespace App\Imports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Question([
            'subject_id' => $row['subject_id'],
            'topic_id' => $row['topic_id'],
            'q_title' => $row['q_title'],
            'q_slug' => \Str::slug($row['q_title']),
            'q_explain' => $row['q_explain'],
        ]);
    }
}
