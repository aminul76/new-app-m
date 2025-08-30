@extends('frontend.master')

 @section('seo')
   <!-- General Meta Tags -->
   

@php
    use Illuminate\Support\Str;
@endphp
   <meta name="description" content="{{ Str::limit(preg_replace('/\s+/', ' ', strip_tags($topic->details)), 160) }}">


   
   <!-- Open Graph Meta Tags for Social Media -->
   <meta property="og:title" content="{{ $topic->t_title}}">
   <meta property="og:description" content="{{ Str::limit(preg_replace('/\s+/', ' ', strip_tags($topic->details)), 160) }}">
   <meta property="og:url" content="{{ url()->current() }}">
   <meta property="og:type" content="topic">
   <meta property="og:site_name" content="{{ config('app.name') }}">
   
   <!-- Twitter Card Meta Tags -->
   <meta name="twitter:card" content="summary_large_image">
   <meta name="twitter:title" content="{{ $topic->t_title}}">
   <meta name="twitter:description" content="{{ Str::limit(preg_replace('/\s+/', ' ', strip_tags($topic->details)), 160) }}">
   
   <!-- Favicon (Optional) -->
   
   <!-- Title -->
   <title>{{ $topic->t_title}}</title>  
@endsection 

@section('style')
   
   <style>
    
    .desktop-header {
        display: block;
    }

    @media (max-width: 767px) {
        .desktop-header {
            display: none;
        }
    }

    
</style>
<link rel="stylesheet" href="{{asset('frontend/css/mark.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/result.css')}}">
@endsection
<div class="desktop-header">
    @include('frontend.include.header')
</div>

@section('content')
<div class="topic-header">
    <button class="back-button" onclick="window.location.href='{{ url('/courses/' . urlencode($course->c_slug) . '/' . urlencode($subject->s_slug)) }}'">
    <span>&#x2190;</span> <!-- Left arrow for back -->
</button>
    <h2 class="topic-title">বিস্তারিত</h2>
</div>

<main>
   
  {!! $topic->details !!}
            
           
  
   <h2>বিগত প্রশ্নগুলো প্রাকটিস করুন</h2>
    <div class="button-container-result ">
    
      
                    <a href="{{ route('topics.questions', [$course->id, $topic->id]) }}" class="btn-result mark">Practice Question</a>
    </div>
             
  @include('frontend.include.subcribe')

    @include('frontend.include.coursefooter')

    
</main>

@section('js')

@endsection
@endsection
