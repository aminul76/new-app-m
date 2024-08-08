<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // Display a listing of the questions.
    public function index()
    {
        $questions = Question::all();
        return view('backend.questions.index', compact('questions'));
    }

    // Show the form for creating a new question.
    public function create()
    {
        $subjects = Subject::all();
        $topics = Topic::all();
        return view('backend.questions.create', compact('subjects', 'topics'));
    }

    // Store a newly created question in the database.
    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'topic_id' => 'required|exists:topics,id',
            'q_title' => 'required|string|max:255',
            'q_slug' => 'required|string|max:255|unique:questions',
            'q_explain' => 'required|string',
        ]);

        Question::create($request->all());

        return redirect()->route('admin.questions.index')->with('success', 'Question created successfully.');
    }

    // Display the specified question.
    public function show(Question $question)
    {
        return view('backend.questions.show', compact('question'));
    }

    // Show the form for editing the specified question.
    public function edit(Question $question)
    {
        $subjects = Subject::all();
        $topics = Topic::all();
        return view('backend.questions.edit', compact('question', 'subjects', 'topics'));
    }

    // Update the specified question in the database.
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'topic_id' => 'required|exists:topics,id',
            'q_title' => 'required|string|max:255',
            'q_slug' => 'required|string|max:255|unique:questions,q_slug,' . $question->id,
            'q_explain' => 'required|string',
        ]);

        $question->update($request->all());

        return redirect()->route('admin.questions.index')->with('success', 'Question updated successfully.');
    }

    // Remove the specified question from the database.
    public function destroy(Question $question)
    {
         // Delete all related options first
    $question->options()->delete();

    // Now delete the question
    $question->delete();

        return redirect()->route('admin.questions.index')->with('success', 'Question deleted successfully.');
    }
}
