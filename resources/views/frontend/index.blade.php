@extends('frontend.master')
@section('seo')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{{ $settings->site_short_description }}">
<meta name="keywords" content="{{ $settings->keyword }}">

<!-- Open Graph Meta Tags -->
<meta property="og:title" content="{{ $settings->site_title }}">
<meta property="og:description" content="{{ $settings->site_description }}">
<meta property="og:image" content="{{ asset('images/siteimage/' . $settings->site_image) }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="article">

<!-- Twitter Card Meta Tags -->
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="{{ $settings->site_title }}">
<meta name="twitter:description" content="{{ $settings->site_short_description }}">
<meta name="twitter:image" content="{{ asset('images/siteimage/' . $settings->site_image) }}">

<!-- Favicon -->
<link rel="icon" href="{{ asset('images/siteimage/' . $settings->site_favicon) }}" type="image/x-icon">

<title>{{ $settings->site_title }}</title>
@endsection
@section('style')



    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">

   

@endsection
@section('content')
    @include('frontend.include.indexheader')
    <main>
        <!-- Title Card -->
        <div class="title-card" style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
            <h2>{{ $settings->site_title }}</h2>
            <p>{{ $settings->site_short_description }}</p>
        </div>

        <!-- Category Cards -->




        <!-- Category Cards -->

        <div class="course-body">
            @foreach ($courses as $course)
                <a class="course-card running" href="{{ url('/courses', $course->c_slug) }}" style="{{ $course->c_colour }}">
                    <img src="{{ asset('images/courseimage/' . $course->c_image) }}" alt="{{ $course->c_title }}">
                    <h3>{{ $course->c_title }}</h3>
                    {{-- <p style="text-align: justify">{{$course->c_description}}</p> --}}
                </a>
            @endforeach
        </div>









</main>
@endsection
