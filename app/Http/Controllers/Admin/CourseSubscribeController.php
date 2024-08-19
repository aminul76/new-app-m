<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\CourseSubscribe;
Use App\Models\User;
Use App\Models\Course;

class CourseSubscribeController extends Controller
{
     public function index()
        {
            $subscriptions = CourseSubscribe::with('user')->get(); // Eager load the user relationship
            return view('backend.course_subscribes.index', compact('subscriptions'));
        }
    
        public function create()
        {
            // Fetch users and courses to populate dropdowns
            $users = User::all();
            $courses = Course::all();
            
            return view('backend.course_subscribes.create', compact('users', 'courses'));
        }
        public function store(Request $request)
        {
            
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'course_id' => 'required|exists:courses,id',
                'subscribed_at' => 'nullable|date',
                'expires_at' => 'nullable|date',
                'status' => 'required|integer|in:1,2',
            ]);

            $subscription = CourseSubscribe::create($validated);
            return redirect()->route('admin.course-subscribes.index')->with('success', 'Subscription created successfully.');
        }
        public function edit(CourseSubscribe $courseSubscribe)
        {
            $users = User::all();
            $courses = Course::all();
            return view('backend.course_subscribes.edit', compact('courseSubscribe', 'users', 'courses'));
        }
        
        public function update(Request $request, CourseSubscribe $courseSubscribe)
        {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'course_id' => 'required|exists:courses,id',
                'subscribed_at' => 'nullable|date',
                'expires_at' => 'nullable|date',
                'status' => 'required|integer|in:1,2',
            ]);
    
            $courseSubscribe->update($validated);
            return redirect()->route('admin.course-subscribes.index')->with('success', 'Subscription updated successfully.');
        }
    
        public function destroy(CourseSubscribe $courseSubscribe)
        {
            $courseSubscribe->delete();
            return redirect()->route('admin.course-subscribes.index')->with('success', 'Subscription deleted successfully.');
        }
    
}
