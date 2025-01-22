
@auth

@extends('frontend.master')

@section('style')
<style>
    .text-success { color: green; }
    .text-danger { color: red; }
    .form-check-input:disabled { background-color: #e9ecef; cursor: not-allowed; }
    .form-check-input[disabled] + label { cursor: not-allowed; }
    #timer-container {
            font-size: 24px;
        }

        .highlight {
            background-color: yellow;
        }

        .critical {
            background-color: red;
            color: white;
        }
        .topic-header {
    width: 100%;
    position: fixed;
    display: flex;
    align-items: center;
    justify-content: start;
    padding: 10px 20px;
    background-color: #fdfdfd;
    border-bottom: 1px solid #ddd;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

.topic-header .topic-title {
    margin: 0; /* Remove default margin to ensure proper alignment */
    padding: 0; /* Remove default padding if any */
}

#timer-container {
    padding-right: 23px;
    display: flex;
    align-items: center;
    margin-left: auto; /* Push the timer container to the right */
}

#timer-container i {
    margin-right: 5px; /* Space between the icon and the text */
}

#timer {
    margin: 0; /* Remove default margin to ensure proper alignment */
    padding: 0; /* Remove default padding if any */
}
button {
    width: calc(100% - 1em);
    padding: 0.75em;
    background: linear-gradient(135deg, #3a7bd5, #00d2ff); /* Blue to Purple Gradient */
    color: #fff;
    border: none;
    border-radius: 15px;
    cursor: pointer;
    font-size: 1em;
    margin-top: 30px;
}

button:hover {
    background-color: #2a5db0;
}

    </style>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            let timer;
            let timeLeft = {{$modelTest->set_time}}; // Total time in seconds

            function formatTime(seconds) {
                const hours = Math.floor(seconds / 3600);
                const minutes = Math.floor((seconds % 3600) / 60);
                const secs = seconds % 60;

                return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
            }

            function updateTimer() {
                const timerElement = document.getElementById('timer');
                timerElement.textContent = formatTime(timeLeft);

                if (timeLeft <= 0) {
                    clearInterval(timer);
                    document.getElementById('answer-form').submit();
                } else if (timeLeft <= 10) {
                    timerElement.classList.add('critical');
                } else if (timeLeft <= 20) {
                    timerElement.classList.add('highlight');
                }
                
                timeLeft--;
            }

            timer = setInterval(updateTimer, 1000);
        });
    </script>

@endsection

@section('content')
<div class="topic-header">
   
    <p class="topic-title">মডেল টেস্ট</p>
    
    <div  id="timer-container">
        <i class="far fa-clock"></i> <p id="timer"></p>&nbsp;&nbsp;
    </div>
  </div>

<main>
<div class="container">
    <h1>{{ $modelTest->title }}</h1>
   
    <form id="answer-form" action="{{ route('author.mode-text.submit', [$course_slug, $modelTest->id]) }}" method="POST">
        @csrf

        @foreach ($modelTest->modelTestQuestions as $index => $modelTestQuestion)
            @if($modelTestQuestion->question)
                <div class="mb-4">
                    <h4> {{ \App\Helpers\DateHelper::toBengaliNumerals($index + 1) }} )  {!! $modelTestQuestion->question->q_title !!}</h4>
                    <div>
                        @foreach ($modelTestQuestion->question->options as $option)
                            <div class="form-check">
                                <input type="radio" name="answers[{{ $modelTestQuestion->question->id }}]" value="{{ $option->id }}">
                                <label>
                                    {!!$option->p_title !!}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="mb-4">
                    <p>Question not found.</p>
                </div>
            @endif
        @endforeach
        <button type="submit">Submit</button>
      
    </form>
    
    @if(session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @endif
</div>
@include('frontend.include.coursefooter')
</main>
@endsection
@endauth
@guest
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>

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

    <link rel="stylesheet" href="{{ asset('frontend/css/sign.css') }}">
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>


    <div class="sing-backround">
        {{-- <a href="{{url('/')}}" class="back-button">
            <i class="fas fa-arrow-left"></i> Back
        </a> --}}
     
        <div class="form-container">
            <h1>সাইন একাউন্ট</h1>

            {{-- <form id="loginForm">
                @csrf
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>

            </form> --}}
           <div class="google-signin">
                <a href="{{ url('auth/google') }}" class="google-button">
                    <i class="fab fa-google google-icon"></i> Sign in with Google
                </a>
            </div>
            <div id="loginMessage"></div>

        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '/ajax-login',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#loginMessage').text(response.message);
                            window.location.href = '/home'; // Redirect to a secure page
                        } else {
                            $('#loginMessage').text(response.message);
                        }
                    },
                    error: function(response) {
                        $('#loginMessage').text('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>

</body>

</html>

@endguest

