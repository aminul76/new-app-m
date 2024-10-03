<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return view('backend.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'c_title' => 'required|string|max:255',
            'c_slug' => 'required|string|max:255|unique:courses',
            'c_description' => 'nullable|string',
            'c_colour' => 'nullable|string',
            'c_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'c_seo_title' => 'nullable|string',
            'c_seo_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Add validation for SEO image
            'c_seo_description' => 'nullable|string',
            'c_keyword' => 'nullable|string',
        ]);
    
        $course = new Course();
        $course->c_title = $request->c_title;
        $course->c_slug = $request->c_slug;
        $course->c_description = $request->c_description;
        $course->c_colour = $request->c_colour;
        $course->c_seo_title = $request->c_seo_title;
        $course->c_seo_description = $request->c_seo_description;
        $course->c_keyword = $request->c_keyword;
        $course->c_subcribe_details = $request->c_subcribe_details;

        $course->c_price = $request->c_price;

        
    
        // Handle the main course image
        if ($request->hasFile('c_image')) {
            $image = $request->file('c_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            
            // Resize and save the image using Intervention Image
            $img = Image::make($image)->resize(800, 600)->save(public_path('images/courseimage/' . $filename));
            
            // Store the filename in the database
            $course->c_image = $filename;
        }
    
        // Handle the SEO image
        if ($request->hasFile('c_seo_image')) {
            $seoImage = $request->file('c_seo_image');
            $seoFilename = time() . '_seo.' . $seoImage->getClientOriginalExtension();
            
            // Resize and save the SEO image using Intervention Image
            $img = Image::make($seoImage)->resize(800, 600)->save(public_path('images/courseimage/' . $seoFilename));
            
            // Store the SEO image filename in the database
            $course->c_seo_image = $seoFilename;
        }
    
        // Save the course instance to the database
        $course->save();
    
        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('backend.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('backend.courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'c_title' => 'required|string|max:255',
            'c_slug' => 'required|string|max:255|unique:courses,c_slug,' . $id,
            'c_description' => 'nullable|string',
            'c_colour' => 'nullable|string',
            'c_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'c_seo_title' => 'nullable|string',
            'c_seo_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'c_seo_description' => 'nullable|string',
            'c_keyword' => 'nullable|string',
        ]);
    
        // Find the existing course by its ID
        $course = Course::findOrFail($id);
    
        // Update the course's details
        $course->c_title = $request->c_title;
        $course->c_slug = $request->c_slug;
        $course->c_description = $request->c_description;
        $course->c_colour = $request->c_colour;
        $course->c_seo_title = $request->c_seo_title;
        $course->c_seo_description = $request->c_seo_description;
        $course->c_keyword = $request->c_keyword;
        $course->c_subcribe_details = $request->c_subcribe_details;
        $course->c_price = $request->c_price;
        
    
        // Handle the main course image
        if ($request->hasFile('c_image')) {
            // Delete the old image if it exists
            if ($course->c_image && file_exists(public_path('images/courseimage/' . $course->c_image))) {
                unlink(public_path('images/courseimage/' . $course->c_image));
            }
    
            // Process the new image
            $image = $request->file('c_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
    
            // Resize and save the image using Intervention Image
            $img = Image::make($image)->resize(800, 600)->save(public_path('images/courseimage/' . $filename));
    
            // Update the filename in the database
            $course->c_image = $filename;
        }
    
        // Handle the SEO image
        if ($request->hasFile('c_seo_image')) {
            // Delete the old SEO image if it exists
            if ($course->c_seo_image && file_exists(public_path('images/courseimage/' . $course->c_seo_image))) {
                unlink(public_path('images/courseimage/' . $course->c_seo_image));
            }
    
            // Process the new SEO image
            $seoImage = $request->file('c_seo_image');
            $seoFilename = time() . '_seo.' . $seoImage->getClientOriginalExtension();
    
            // Resize and save the SEO image using Intervention Image
            $img = Image::make($seoImage)->resize(800, 600)->save(public_path('images/courseimage/' . $seoFilename));
    
            // Update the SEO image filename in the database
            $course->c_seo_image = $seoFilename;
        }
    
        // Save the updated course in the database
        $course->save();
    
        // Redirect back to the courses index with a success message
        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        // Check and delete the associated images if they exist
        if ($course->c_image && file_exists(public_path('images/courseimage/' . $course->c_image))) {
            unlink(public_path('images/courseimage/' . $course->c_image));
        }
    
        if ($course->c_seo_image && file_exists(public_path('images/courseimage/' . $course->c_seo_image))) {
            unlink(public_path('images/courseimage/' . $course->c_seo_image));
        }
    
        // Delete the course record
        $course->delete();
    
        // Redirect back to the index page with a success message
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }
}
