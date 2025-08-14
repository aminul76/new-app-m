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

            scroll-behavior: smooth;
            /* Optional: for smooth scrolling */
        }




        .active-date {
            background-color: #3a3de4;
            /* Highlight color for the active date */
            color: #fff;
            /* Text color for the active date */
            font-weight: bold;
            border: 2px solid #062ba3;
            /* Optional border to make it more prominent */
        }

        /* .active-date::after {
        content: "✓";
        position: absolute;
        bottom: -10px;
        right: -10px;
        font-size: 16px;
        color: #fff;
    } */
        .exam-card {
            width: 300px;
            height: 150px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            border-radius: 8px;
            background-color: #00a5c9;

        }

        .container {
            text-align: center;
        }

        .video-section {
            background-color: #00a5c9;
            width: 300px;
            height: 150px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;

        }

        .video-title {
            color: white;
            font-size: 18px;
            font-weight: bold;
            position: relative;
        }

        .play-icon {
            font-size: 16px;
            color: black;
            background: #ffffffbf;
            ;
            border-radius: 50%;
            padding: 5px;
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }

        .button-group {
            margin-top: 20px;
        }

        .action-button {
            background-color: #ff3b3b;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 5px;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }


        .live-text {
            position: absolute;
            top: -5px;
            right: -10px;
            background-color: #ff0000;
            color: white;
            padding: 5px 5px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 10px;
            text-transform: uppercase;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            opacity: 1;
            transition: background-color 0.3s ease;
        }

        .action-button:hover {
            background-color: #d73232;
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
                    'url' => route('video-view.date', [
                        'courseSlug' => $course->c_slug,
                        'date' => $currentDate->format('Y-m-d'),
                    ]),
                    'isToday' => $currentDate->format('Y-m-d') === $today,
                ];
                $currentDate->addDay();
            }
        @endphp




@php
$user = Auth::user();



// Check if user is authenticated before attempting to access their ID
if ($user) {
    $subscription = \App\Models\CourseSubscribe::where('user_id', $user->id)
        ->where('course_id', $course->id)
        ->where(function ($query) {
            $query->whereNull('expires_at')
                  ->orWhere('expires_at', '>=', Carbon::now());
        })
        ->first();
} else {
    $subscription = null; // Set subscription to null if user is not authenticated
}
@endphp






        <div class="day-header-container">
            <div class="day-header">
                @foreach ($dates as $date)
                    <div id="{{ $date['isToday'] ? 'current-date' : '' }}"
                        class="{{ $date['isToday'] ? 'active-date' : '' }}">
                        <a href="{{ $date['url'] }}">{{ $date['day'] }}</a>
                    </div>
                @endforeach
            </div>
        </div>




        <div class="routine-card">

            <div class="routine-header">
                <h4>{{ $dateBangla }} তারিখের পরিক্ষা</h4>
            </div>

            @foreach ($videos as $video)
                <div class="container">
                    <a href="{{ route('video-play.play', [$course->c_slug, $video->id]) }}" class="exam-card">
                        <div class="live-text">Live</div>
                        <div class="video-section">
                            <div class="video-title">
                                <p>{{ $video->title }}</p>
                                <div class="play-icon">▶</div>
                            </div>
                        </div>
                    </a>


                   
                
                    
                @if (!$user)
                @if (!$subscription)
                <div class="button-group">
                    <a href="{{ url('author/subcribe/view', $course->id) }}" target="_blank"
                        class="action-button">Start Exam</a>
                    <a href="{{ url('author/subcribe/view', $course->id) }}" target="_blank"
                        class="action-button">Lecture Sheet</a>
                </div>
                @else
                <div class="button-group">
                <a href="{{ url('author/subcribe/view', $course->id) }}" target="_blank"
                    class="action-button">Start Exam</a>
                <a href="{{ url('author/subcribe/view', $course->id) }}" target="_blank"
                    class="action-button">Lecture Sheet</a>
                </div>
                @endif
                @elseif($subscription==null)
                <div class="button-group">
                <a href="{{ url('author/subcribe/view', $course->id) }}" target="_blank"
                    class="action-button">Start Exam</a>
                <a href="{{ url('author/subcribe/view', $course->id) }}" target="_blank"
                    class="action-button">Lecture Sheet</a>
                </div>

                @endif
                @if ($user)
                @if ($subscription)
                        <div class="button-group">
                            <a href="{{ $video->class_test_link }}" target="_blank" class="action-button">Start
                                        Exam</a>
                            <a href="{{ $video->pdf_link }}" target="_blank" class="action-button">Lecture Sheet</a>


                </div>
                @endif
                @endif




                                


        </div>
            @endforeach




            {{-- <div class="exam-cards">
            @foreach ($modelTests as $modelTest)
               @auth
               <a href="{{ route('author.mode-text.exam', [$course->c_slug, $modelTest->id]) }}" class="exam-card">
                <div class="live-text">Live</div>
                <div class="exam-details">
                    <div class="subject-header">
                        <h3 class="subject-name">
                            <i class="fas fa-calendar-alt subject-icon"></i>
                           {{$modelTest->title}}
                        </h3>
                        <div class="subject-mark">Marks: {{$modelTest->mark}}</div>
                    </div>
                    <div class="topic-details">
                       
                          {!!$modelTest->m_description!!}
                        
                        
                       
                    </div>
                    <p class="exam-date">
                       
                        <span> Start Time: {{ \Carbon\Carbon::parse($modelTest->start_date)->format('g:i A') }} -   End Time: {{ \Carbon\Carbon::parse($modelTest->end_date)->format('g:i A') }}</span>
                    </p>
                </div>
            </a>
               @endauth 
             
               @guest
               <a href="{{ url('/profile', $course->c_slug) }}" class="exam-card">
                <div class="live-text">Live</div>
                <div class="exam-details">
                    <div class="subject-header">
                        <h3 class="subject-name">
                            <i class="fas fa-calendar-alt subject-icon"></i>
                           {{$modelTest->title}}
                        </h3>
                        <div class="subject-mark">Marks: {{$modelTest->mark}}</div>
                    </div>
                    <div class="topic-details">
                       
                          {!!$modelTest->m_description!!}
                        
                        
                       
                    </div>
                    <p class="exam-date">
                       
                        <span> Start Time: {{ \Carbon\Carbon::parse($modelTest->start_date)->format('g:i A') }} -   End Time: {{ \Carbon\Carbon::parse($modelTest->end_date)->format('g:i A') }}</span>
                    </p>
                </div>
            </a>
               @endguest
           
            @endforeach
            <!-- Add more exam cards as needed -->
        </div> --}}




      











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
    @endsection

@endsection
