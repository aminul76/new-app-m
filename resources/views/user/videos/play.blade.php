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
    <link rel="stylesheet" href="{{ asset('frontend/css/routine.css') }}">

  <!-- Plyr CSS -->
  <link rel="stylesheet" href="https://www.bdprofessionalskills.com/frontend/assets/css/plyr.css">

  <!-- Plyr Polyfill JS -->
  <script src="https://www.bdprofessionalskills.com/frontend/assets/js/polyfilled.js"></script>

  <style>
    /* Responsive video container */
    .video-wrapper {
      position: relative;
      padding-bottom: 56.25%; /* 16:9 aspect ratio */
      height: 0;
      overflow: hidden;
      max-width: 100%;
    }

    /* Style for the iframe video */
    .video-wrapper iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }

    /* Cover styles (Optional) */
    .cover {
      position: absolute;
      bottom: 0;
      right: 0;
      width: 40%;
      height: 40%;
      background-color: rgba(0, 0, 0, 0); /* Transparent cover */
    }

    .cover-2 {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 30%;
      background-color: rgba(0, 0, 0, 0); /* Transparent cover */
    }

    /* Adjust Plyr iframe styling */
    .plyr iframe[id^=youtube] {
      top: -50%;
      height: 200%;
    }

    iframe {
      pointer-events: none;
    }
  </style>
@endsection

@section('content')

<div class="topic-header">
    <button class="back-button" onclick="window.location.href='{{ url('/video-view/current', $course->c_slug) }}'">
        <span>&#x2190;</span> <!-- Left arrow for back -->
    </button>
    <h2 class="topic-title">ভিডিও</h2>
  </div>

<main>


  <!-- Video Wrapper with Plyr -->
  <div class="video-wrapper">
    <div class="plyr__video-embed" id="player">
      {!!$video->video_link!!}
    </div>
  </div>

 


        <!-- Subscription Section -->
        @include('frontend.include.subcribe')

        @include('frontend.include.coursefooter')


    @section('js')
       <!-- Plyr JS Initialization -->
  <script>
    const player = new Plyr('#player', {
      title: 'Example Title',  // You can customize this title
    });

    // Expose player for console usage
    window.player = player;
  </script>

  <!-- Disable Right-Click Context Menu -->
  <script>
    document.addEventListener('contextmenu', event => event.preventDefault());
  </script>
    @endsection

@endsection


