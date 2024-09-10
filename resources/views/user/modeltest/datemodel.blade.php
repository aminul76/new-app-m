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
<style>
    .day-header-container {
        scroll-behavior: smooth; /* Optional: for smooth scrolling */
        overflow-x: auto; /* Enables horizontal scrolling */
        white-space: nowrap; /* Prevents wrapping of child elements */
    }

   
    .active-date {
        background-color: #007bff; /* Highlight color for the active date */
        color: #fff; /* Text color for the active date */
        font-weight: bold;
        border: 2px solid #0056b3; /* Optional border to make it more prominent */
    }

    .active-date::after {
        content: "✓"; /* Optional: add a checkmark or any other icon to indicate active */
        position: absolute;
        bottom: -10px; /* Position it below the circle */
        right: -10px;
        font-size: 16px;
        color: #fff;
    }

</style>
@endsection

@section('content')
@include('frontend.include.header')

<main>
    @php
        use Carbon\Carbon;

        // Convert the provided date string to a Carbon instance
        $selectdateDate = Carbon::parse($date);
        $selectdate = $selectdateDate->format('Y-m-d');

        // Calculate the start and end dates (10 days before and after selectdate)
        $startDate = $selectdateDate->copy()->subDays(10);
        $endDate = $selectdateDate->copy()->addDays(10);

        // Generate URLs and determine if it's selectdate
        $dates = [];
        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $dates[] = [
                'day' => $currentDate->format('j'),
                'date' => $currentDate->format('Y-m-d'),
                'url' => route('model-tests.date', ['courseSlug' => $course->c_slug, 'date' => $currentDate->format('Y-m-d')]),
                'isselectdate' => $currentDate->format('Y-m-d') === $selectdate,
            ];
            $currentDate->addDay();
        }
    @endphp

    <div class="day-header-container">
        <div class="day-header">
            @foreach($dates as $date)
                <div id="{{ $date['isselectdate'] ? 'current-date' : '' }}" class="{{ $date['isselectdate'] ? 'active-date' : '' }}">
                    <a href="{{ $date['url'] }}">{{ $date['day'] }}</a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="routine-card">
        <div class="routine-header">
          <!-- In your Blade view file -->
<h4>{{ $dateBangla}} তারিখের পরিক্ষার</h4>

        </div>

        <div class="exam-cards">
            @forelse ($modelTests as $modelTest)
                <div class="exam-card">
                    <div class="exam-details">
                        <div class="subject-header">
                            <h3 class="subject-name">
                                <i class="fas fa-calendar-alt subject-icon"></i>
                                {{ $modelTest->title }}
                            </h3>
                            <div class="subject-mark">Marks: 100</div>
                        </div>
                        <div class="topic-details">
                            <p class="topic-name">
                                <i class="fas fa-book topic-icon"></i> Algebra
                            </p>
                            <p class="points">Marks: 20</p>
                        </div>
                        <p class="exam-date">
                            <span class="exam-time">10:00 AM - 12:00 PM</span>
                        </p>
                    </div>
                </div>
                @empty
                <p>upcoming exam</p>
                @endforelse
        </div>
    </div>

    <!-- Subscription Section -->
    <div class="subscription-section">
        <h2 class="subscription-title">Subscribe to our newsletter</h2>
        <button class="subscription-b-btn">Subscribe</button>
    </div>

    @include('frontend.include.coursefooter')

    @section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var currentDateElement = document.getElementById('current-date');
            
            if (currentDateElement) {
                var container = document.querySelector('.day-header-container');
                var containerWidth = container.clientWidth;
                var elementWidth = currentDateElement.offsetWidth;
                var elementOffset = currentDateElement.offsetLeft;

                // Calculate the scroll position to center the current date
                var scrollLeft = elementOffset - (containerWidth / 2) + (elementWidth / 2);
                
                // Set the scroll position
                container.scrollLeft = scrollLeft;
            }
        });
    </script>
    @endsection
</main>
@endsection
