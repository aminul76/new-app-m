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
@endsection





@section('content')

<div class="topic-header">
    <button class="back-button" onclick="window.location.href='{{ url('/courses', $course->c_slug) }}'">
        <span>&#x2190;</span> <!-- Left arrow for back -->
    </button>
    <h2 class="topic-title">অনুশীলন</h2>
  </div>

<main>







    <div class="subject-icons-section">


        @forelse ($topics as $topics)
        <a href="{{ route('topics.questions', [$course->id, $topics->topic_id]) }}" class="subject-icon-card">
            <i class="fas fa-book"></i>
            <p>{{ $topics->topic_name }}</p>
            @if ($subscription==null)
            <i class="fas fa-lock"></i>  
            @else
            <i class="fas fa-chevron-right"></i>   
            @endif
            
          
        </a>
        @empty
            <p>No subjects available for this course.</p>
        @endforelse

        </div>




        @include('frontend.include.subcribe')

    @include('frontend.include.coursefooter')


</main>



@endsection

