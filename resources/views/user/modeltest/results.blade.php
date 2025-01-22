<!-- resources/views/user/modeltest/results.blade.php -->
@auth
@extends('frontend.master')

@section('style')
<style>
    .text-success { color: green; }
    .text-danger { color: red; }
    .option-correct { color: green; }
    .option-wrong { color: red; }
    input[type="radio"] {
    position: relative;
    width: 15px;
    height: 15px;
    appearance: none;
    border: 2px solid #666;
    border-radius: 50%;
    outline: none;
    cursor: pointer;
    background-color: #fff;
    transition: background-color 0.3s, border-color 0.3s;
  }
  
  /* Styling when the radio button is checked */
  input[type="radio"]:checked {
    background-color: #007bff;
    border-color: #007bff;
  }
  
  /* Styling when the radio button is disabled */
  input[type="radio"]:disabled {
    cursor: not-allowed;
    background-color: #e9ecef;
    border-color: #ced4da;
  }

  /* Styling when the radio button is checked and disabled */
  input[type="radio"]:checked:disabled {
    background-color: #6c757d;
    border-color: #6c757d;
  }
 

</style>
<link rel="stylesheet" href="{{asset('frontend/css/mark.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/result.css')}}">

@endsection

@section('content')
<div class="topic-header">
    <button class="back-button" onclick="javascript:history.go(-2)">
        <span>&#x2190;</span> <!-- Left arrow for back -->
    </button>
    <h2 class="topic-title">পরিক্ষার রিজাল্ট</h2>
</div>

<main>


    <div class="container-mark-div">
        <div class="container-mark">
            <div class="header-mark">
                <h1>{{ $modelTest->title }}</h1>
                <p>{{ auth()->user()->name }}</p>
                <p>পরিক্ষার তারিখ: {{$dateBangla}}</p>
            </div>
            {{-- <div class="marks-mark">
                <div class="status-info">
                    মোট পরীক্ষার্থী সংখ্যা<br>{{ $totals->total_users +225}}
                </div>
                <div class="status-success">
                    উত্তীর্ণ পরীক্ষার্থীর সংখ্যা<br>1283
                </div>
            </div>
            --}}
            <div class="marks-mark"> 
                <div class="status-success">
                   সঠিক উত্তর<br>{{ $totals->total_right_answers }} টি
                </div>
                <div class="marks-failed">
                    আপনার মার্ক<br>{{ $totals->total_right_answers - $totals->total_wrong_answers*.25 }}
                </div>


            </div>

            {{-- <div class="marks-mark">


                <div class="marks-failed">
                    আপনার ফলাফল<br>অনুত্তীর্ণ
                </div>
                <div class="status-info">
                    আপনার অবস্থান<br>5606 থেকে 5907 এর মধ্যে।
                </div>
            </div> --}}
            <div class="table-responsive">
                <table class="mark-sheet">
                    <thead>
                        <tr>
                            <th>বিষয়</th>
                            <th>সঠিক</th>
                            <th>ভুল</th>
                            <th>মার্ক</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($subjects as $subject)
                        <tr>
                            <td>{{ $subject->subject_name }}</td>
                            <td>{{ $subject->right_answers }}</td>
                            <td>{{ $subject->wrong_answers }}</td>
                            <td>{{ $subject->right_answers - $subject->wrong_answers*.25 }}</td>
                        </tr>
                    @endforeach
                        <tr>
                            <td>মোট</td>
                            <td>{{ $totals->total_right_answers }}</td>
                            <td>{{ $totals->total_wrong_answers }}</td>
                            <td>{{ $totals->total_right_answers - $totals->total_wrong_answers*.25 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            {{-- <div class="preparation-level">
                <div class="preparation-poor">খারাপ</div>
            </div>
            <div class="buttons-mark">
                <a href="#" class="button-view-answer">উত্তরপত্র দেখুন</a>
                <a href="#" class="button-merit-list">মেরিট লিস্ট</a>
            </div> --}}
        </div>
    </div>
<div class="container">
   
    @foreach ($modelTest->modelTestQuestions as $modelTestQuestion)
        @if($modelTestQuestion->question)
            <div class="mb-4">
                <h4>{!! $modelTestQuestion->question->q_title !!}</h4>
                <div>
                    @foreach ($modelTestQuestion->question->options as $option)
                        @php
                            $isUserAnswer = isset($userAnswers[$modelTestQuestion->question->id]) && $userAnswers[$modelTestQuestion->question->id] == $option->id;
                            $isCorrectAnswer = $option->is_correct;
                        @endphp
                        <div class="form-check">
                            <input type="radio" disabled {{ $isUserAnswer ? 'checked' : '' }}>
                            <label class="{{ $isUserAnswer ? ($isCorrectAnswer ? 'option-correct' : 'option-wrong') : ($isCorrectAnswer ? 'text-success' : '') }}">
                                {!! $option->p_title !!}
                            </label>
                        </div>
                    @endforeach
                </div>
                <p>{!! $modelTestQuestion->question->q_explain !!}</p>

            </div>
           
        @else
            <div class="mb-4">
                <p>Question not found.</p>
            </div>
        @endif
    @endforeach

       
          
         
         
           
         
                 <div class="button-container-result ">
                    <a href="{{ route('author.merit-list', [$course->c_slug, $modelTest->id]) }}" class="btn-result mark">মেধাতালিকা</a>
                </div>
     

    
    {{-- <a href="{{ route('author.mode-text.exam', [$course_slug, $modelTest->id]) }}" class="btn btn-primary">Retry Exam</a> --}}
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

