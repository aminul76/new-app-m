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



    /* styles.css */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

.modal-content {
    
    color: #ffff;
    background: linear-gradient(25deg, #3a54d5, #ff0000);
    border-radius: 21px;
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    text-align: center;
}

.close-btn {
    color: #ffffff;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close-btn:hover,
.close-btn:focus {
    color: black;
    text-decoration: none;
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


            if ($selectdateDate->isPast()) {
            $message = "Time's up";
            } elseif ($selectdateDate->isFuture()) {
                $message = "Upcoming";
            } else {
                $message = "Ongoing"; // Optional: Handle case where the date is today
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
            <div class="exam-card" data-title="{{ $modelTest->title }}" data-description="{{ $modelTest->m_description }}" data-times="Start Time: {{ \Carbon\Carbon::parse($modelTest->start_date)->format('g:i A') }} - End Time: {{ \Carbon\Carbon::parse($modelTest->end_date)->format('g:i A') }}" data-mark="{{ $modelTest->mark }}">
                <div class="exam-details">
                        <div class="subject-header">
                            <h3 class="subject-name">
                                <i class="fas fa-calendar-alt subject-icon"></i>
                                {{ $modelTest->title }}
                            </h3>
                            <div class="subject-mark">{{$modelTest->mark}}</div>
                        </div>
                        <div class="topic-details">
                            {!!$modelTest->m_description!!}
                        </div>
                        <p class="exam-date">
                            <span> Start Time: {{ \Carbon\Carbon::parse($modelTest->start_date)->format('g:i A') }} -   End Time: {{ \Carbon\Carbon::parse($modelTest->end_date)->format('g:i A') }}</span>
                        </p>
                    </div>
                </div>
                @empty
                
                @endforelse
        </div>
    </div>


    <!-- Modal Structure -->
    <div id="examModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h3>{{$message}}</h3>
        </div>
    </div>
    <!-- Subscription Section -->
  
    @include('frontend.include.subcribe')

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
    <script>
        // script.js
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById("examModal");
    var span = document.getElementsByClassName("close-btn")[0];

    // Function to show the modal
    function showModal() {
        modal.style.display = "block";
    }

    // Get all exam cards
    var examCards = document.querySelectorAll('.exam-card');

    // Add click event listeners to all exam cards
    examCards.forEach(function(card) {
        card.addEventListener('click', function() {
            showModal();
        });
    });

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});

    </script>
    @endsection
</main>
@endsection
