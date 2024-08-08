<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Subject;


class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $topics = Topic::with('subject')->get();
          
       
        return view('backend.topics.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all();
        return view('backend.topics.create', compact('subjects'));
      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            't_title' => 'required|string|max:255',
            't_slug' => 'required|string|max:255|unique:topics',
        ]);

        Topic::create($request->all());

        return redirect()->route('admin.topics.index')->with('success', 'Topic created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic)
    {
        return view('backend.topics.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
       
            $subjects = Subject::all();
            return view('backend.topics.edit', compact('topic', 'subjects'));
     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Topic $topic)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            't_title' => 'required|string|max:255',
            't_slug' => 'required|string|max:255|unique:topics,t_slug,' . $topic->id,
        ]);

        $topic->update($request->all());

        return redirect()->route('admin.topics.index')->with('success', 'Topic updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();

        return redirect()->route('admin.topics.index')->with('success', 'Topic deleted successfully.');
    }
}
