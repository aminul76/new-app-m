<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
Use App\Models\Topic;

class CourseTopicController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $courses = Course::with('topics')->get();
        return view('backend.course_topic.index', compact('courses'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $courses = Course::all();
        $topics = Topic::all();
        return view('backend.course_topic.create', compact('courses', 'topics'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'topics' => 'array|required',
        ]);

        $course = Course::findOrFail($validatedData['course_id']);
        $course->topics()->sync($validatedData['topics']); // Attach selected topics to course

        return redirect()->route('admin.course-topic.index');
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $course = Course::with('topics')->findOrFail($id);
        $topics = Topic::all();

        return view('backend.course_topic.edit', compact('course', 'topics'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {


        $validatedData = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'topics' => 'array|required',
        ]);


        $course = Course::findOrFail($id);
        $course->topics()->sync($request->topics); // Sync topics with course

        return redirect()->route('admin.course-topic.index');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->topics()->detach(); // Detach all topics
        $course->delete(); // Optionally delete the course

        return redirect()->route('admin.course-topic.index');
    }
}
