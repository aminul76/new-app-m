<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Course;
use Carbon\Carbon;


class VideoController extends Controller
{
   // Display a listing of the videos
   public function index()
   {
       $videos = Video::all();
       return view('backend.videos.index', compact('videos'));
   }

   // Show the form for creating a new video
   public function create()
   {
       $courses = Course::all(); // Get all courses for dropdown
       return view('backend.videos.create', compact('courses'));
   }

   // Store a newly created video in the database
   public function store(Request $request)
   {
       $request->validate([
           'title' => 'required|string|max:255',
           'course_id' => 'required|exists:courses,id',
           'status' => 'required|integer',
           'm_description' => 'nullable|string',
           'video_link' => 'nullable|string',
           'pdf_link' => 'nullable|string',
           'class_test_link' => 'nullable|string',
           'mark' => 'nullable|string',
           'start_date' => 'required|date',
           'end_date' => 'required|date',
       ]);

       Video::create($request->all());
       return redirect()->route('admin.videos.index')->with('success', 'Video created successfully.');
   }

   // Show the details of a specific video
   public function show($id)
   {
       $video = Video::findOrFail($id);
       return view('backend.videos.show', compact('video'));
   }

   // Show the form for editing a video
   public function edit($id)
   {
       $video = Video::findOrFail($id);
       $courses = Course::all();
       return view('backend.videos.edit', compact('video', 'courses'));
   }

   // Update the video in the database
   public function update(Request $request, $id)
   {
       $request->validate([
           'title' => 'required|string|max:255',
           'course_id' => 'required|exists:courses,id',
           'status' => 'required|integer',
           'm_description' => 'nullable|string',
           'video_link' => 'nullable|string',
           'pdf_link' => 'nullable|string',
           'class_test_link' => 'nullable|string',
           'mark' => 'nullable|string',
           'start_date' => 'required|date',
           'end_date' => 'required|date',
       ]);

       $video = Video::findOrFail($id);
       $video->update($request->all());
       return redirect()->route('admin.videos.index')->with('success', 'Video updated successfully.');
   }

   // Delete the video from the database
   public function destroy($id)
   {
       $video = Video::findOrFail($id);
       $video->delete();
       return redirect()->route('admin.videos.index')->with('success', 'Video deleted successfully.');
   }


   public function editAll($id)
   {
        $video = Video::findOrFail($id);
       return view('backend.videos.edit_all',compact('video'));
   }

   // Update the start date for all videos by adding the number of days
   public function updateAll(Request $request)
   {
       // Validate the input
      // Request থেকে start_date নিন
    $start_date = Carbon::parse($request->input('start_date'));
    $end_date = Carbon::parse($request->input('end_date'));

    // সমস্ত ভিডিও আপডেট করার জন্য loop চালান
    $videos = Video::all();
    
    foreach ($videos as $index => $video) {
        // সিরিয়াল হিসেবে তারিখ পরিবর্তন করুন
        $video->start_date = $start_date->copy()->addDays($index);
        $video->end_date = $end_date->copy()->addDays($index);
        $video->save();
    }

    // সফলভাবে আপডেট হওয়ার পর রিডিরেক্ট বা মেসেজ দিন
    return redirect()->route('admin.videos.index')->with('success', 'All video start dates have been updated.');
   }


}
