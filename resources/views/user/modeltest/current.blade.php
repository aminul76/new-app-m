@extends('frontend.master')
@section('style')

<link rel="stylesheet" href="{{asset('frontend/css/routine.css')}}">
<style>


.day-header-container {

    scroll-behavior: smooth; /* Optional: for smooth scrolling */
}




.active-date {
    background-color: #3a3de4; /* Highlight color for the active date */
    color: #fff; /* Text color for the active date */
    font-weight: bold;
    border: 2px solid #062ba3; /* Optional border to make it more prominent */
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

    // Get today's date
    $todayDate = now();
    $today = $todayDate->format('Y-m-d');

    // Calculate the start and end dates (10 days before and after today)
    $startDate = $todayDate->copy()->subDays(10);
    $endDate = $todayDate->copy()->addDays(10);

    // Generate URLs and determine if it's today
    $dates = [];
    $currentDate = $startDate->copy();
    while ($currentDate <= $endDate) {
        $dates[] = [
            'day' => $currentDate->format('j'),
            'date' => $currentDate->format('Y-m-d'),
            'url' => route('model-tests.date', ['courseSlug' => $course->c_slug, 'date' => $currentDate->format('Y-m-d')]),
            'isToday' => $currentDate->format('Y-m-d') === $today,
        ];
        $currentDate->addDay();
    }
@endphp

<div class="day-header-container">
    <div class="day-header">
        @foreach($dates as $date)
            <div id="{{ $date['isToday'] ? 'current-date' : '' }}" class="{{ $date['isToday'] ? 'active-date' : '' }}">
                <a href="{{ $date['url'] }}">{{ $date['day'] }}</a>
            </div>
        @endforeach
    </div>
</div>




    <div class="routine-card">

        <div class="routine-header">
            <h4>{{ $dateBangla}} তারিখের পরিক্ষা</h4>
        </div>


        <div class="exam-cards">
            @foreach ($modelTests as $modelTest)
                
            
            <a href="{{ route('author.mode-text.exam', [$course->c_slug, $modelTest->id]) }}" class="exam-card">
                <div class="live-text">Live</div>
                <div class="exam-details">
                    <div class="subject-header">
                        <h3 class="subject-name">
                            <i class="fas fa-calendar-alt subject-icon"></i>
                           {{$modelTest->title}}
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
            </a>
            @endforeach
            <!-- Add more exam cards as needed -->
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

@endsection
