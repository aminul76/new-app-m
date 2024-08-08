<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;

class OptionController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $options = Option::with('question')->get();
        return view('backend.options.index', compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $questions = Question::all();
        return view('backend.options.create', compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'p_title' => 'required|string|max:255',

        ]);

        Option::create($request->all());

        return redirect()->route('admin.options.index')->with('success', 'Option created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Option $option)
    {
        return view('backend.options.show', compact('option'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option)
    {
        $questions = Question::all();
        return view('backend.options.edit', compact('option', 'questions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Option $option)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'p_title' => 'required|string|max:255',
            'is_correct' => 'sometimes|boolean',
        ]);

        $option->update([
            'question_id' => $request->input('question_id'),
            'p_title' => $request->input('p_title'),
            'is_correct' => $request->has('is_correct') ? 1 : 0,
        ]);

        return redirect()->route('admin.options.index')->with('success', 'Option updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        $option->delete();

        return redirect()->route('admin.options.index')->with('success', 'Option deleted successfully.');
    }
}
