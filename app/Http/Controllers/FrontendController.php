<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\course;

class FrontendController extends Controller
{
   public function index(){

    $courses = Course::all();
    return view('frontend.index',compact('courses'));

   }
   public function courses($slug)
   {


       $courses = Course::where('c_slug', $slug)->get();

       return view('frontend.course', compact('courses'));
   }
}
