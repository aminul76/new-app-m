<?php
namespace App\Imports;

use App\Models\Option;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OptionsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Option([
            'question_id' => $row['question_id'],
            'p_title' => $row['p_title'],
            'is_correct' => $row['is_correct'],
        ]);
    }
}
