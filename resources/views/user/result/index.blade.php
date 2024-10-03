
@extends('frontend.master')
@section('seo')
   <!-- General Meta Tags -->
   <meta name="description" content="{{ $course->c_seo_description ?? $course->c_description }}">
   <meta name="keywords" content="{{ $course->c_keyword }}">
   
   <!-- Open Graph Meta Tags for Social Media -->
   <meta property="og:title" content="{{ $course->c_seo_title ?? $course->c_title }}">
   <meta property="og:description" content="{{ $course->c_seo_description ?? $course->c_description }}">
   <meta property="og:image" content="{{ asset('images/courseimage/' . $course->c_seo_image) }}">
   <meta property="og:url" content="{{ url()->current() }}">
   <meta property="og:type" content="course">
   <meta property="og:site_name" content="{{ config('app.name') }}">
   
   <!-- Twitter Card Meta Tags -->
   <meta name="twitter:card" content="summary_large_image">
   <meta name="twitter:title" content="{{ $course->c_seo_title ?? $course->c_title }}">
   <meta name="twitter:description" content="{{ $course->c_seo_description ?? $course->c_description }}">
   <meta name="twitter:image" content="{{ asset('images/courseimage/' . $course->c_seo_image) }}">
   
   <!-- Favicon (Optional) -->
   <link rel="icon" href="{{ asset('images/courseimage/' . $course->c_image) }}" type="image/x-icon">
   
   <!-- Title -->
   <title>{{ $course->c_seo_title ?? $course->c_title }}</title>  
@endsection
@section('style')
<link rel="stylesheet" href="{{asset('frontend/css/result.css')}}">

@endsection
@section('content')
@include('frontend.include.header')
<main>
  

    <div class="exam-cards">
     

        @foreach ($exam_records as $record)
        <div class="exam-card">
            <div class="exam-details">
              
             
                <h3 class="subject-name">
               
                    Model Test Name: {{ $record->modelTest->title }}
              
                
                     </h3>
                     <p>Correct Answers Count: {{ $record->correct_answers_count }}</p>
            <p>Incorrect Answers Count: {{ $record->incorrect_answers_count }}</p>
                     <div class="button-container-result ">
                        <a href="{{ route('author.mode-text.exam', [$course->c_slug, $record->modelTest->id]) }}" class="btn-result anware">উত্তরপত্র</a>
                        <a href="{{ route('author.merit-list', [$course->c_slug, $record->modelTest->id]) }}" class="btn-result mark">মেধাতালিকা</a>
                    </div>
            </div>
        </div>


        @endforeach
  
    
   
   

 
    </div>
    @include('frontend.include.subcribe')
@include('frontend.include.coursefooter')



</main>



@endsection
