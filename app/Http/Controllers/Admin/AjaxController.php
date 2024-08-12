<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\Question;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getTopics($subjectId)
    {
        $topics = Topic::where('subject_id', $subjectId)->get();
        return response()->json(['topics' => $topics]);
    }

    public function getQuestions($topicId)
    {
        $questions = Question::where('topic_id', $topicId)->get();
        return response()->json(['questions' => $questions]);
    }

}
