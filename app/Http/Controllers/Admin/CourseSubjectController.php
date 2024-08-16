<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
Use App\Models\Subject;

class CourseSubjectController extends Controller
{
     // Display a listing of the resource.
     public function index()
     {
         $courses = Course::with('subjects')->get();
         return view('backend.course_subject.index', compact('courses'));
     }

     // Show the form for creating a new resource.
     public function create()
     {
         $courses = Course::all();
         $subjects = Subject::all();
         return view('backend.course_subject.create', compact('courses', 'subjects'));
     }

     // Store a newly created resource in storage.
     public function store(Request $request)
     {
         $validatedData = $request->validate([
             'course_id' => 'required|exists:courses,id',
             'subjects' => 'array|required',
         ]);

         $course = Course::findOrFail($validatedData['course_id']);
         $course->subjects()->sync($validatedData['subjects']); // Attach selected subjects to course

         return redirect()->route('admin.course-subject.index');
     }

     // Show the form for editing the specified resource.
     public function edit($id)
     {
         $course = Course::with('subjects')->findOrFail($id);
         $subjects = Subject::all();

         return view('backend.course_subject.edit', compact('course', 'subjects'));
     }

     // Update the specified resource in storage.
     public function update(Request $request, $id)
     {


         $validatedData = $request->validate([
             'course_id' => 'required|exists:courses,id',
             'subjects' => 'array|required',
         ]);


         $course = Course::findOrFail($id);
         $course->subjects()->sync($request->subjects); // Sync subjects with course

         return redirect()->route('admin.course-subject.index');
     }

     // Remove the specified resource from storage.
     public function destroy($id)
     {
         $course = Course::findOrFail($id);
         $course->subjects()->detach(); // Detach all subjects
         $course->delete(); // Optionally delete the course

         return redirect()->route('admin.course-subject.index');
     }
}
