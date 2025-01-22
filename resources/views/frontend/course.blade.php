{{-- @auth --}}
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
@include('frontend.include.header')
<main>
    <!-- Title Card -->
    <div class="title-card">
        <h2>{{ $course->c_title }}</h2>
        <p>{{ $course->c_description }}</p>
    </div>

    <!-- Category Cards -->




    <!-- Category Cards -->








   
    <div class="category-cards">






        <a href="{{ url('/model-tests/current', $course->c_slug) }}" class="category-card">
            <div class="card-icon"><i class="fas fa-calendar-check"></i></div>
            <div class="card-content">
                <h2 class="card-title">রুটিন এক্সাম</h2>
            </div>
            <div class="live-text">Live</div>
        </a>

        @if (!$modelTest)
        <a href="#" class="category-card">
            <div class="card-icon"><i class="fas fa-graduation-cap"></i></div>
            <div class="card-content">
                <h2 class="card-title">ফ্রি এক্সাম</h2>
            </div>
            <div class="live-text">Free</div>
        </a> 
        @else
        <a href="{{ route('author.mode-text.free', [$course->c_slug, $modelTest->id]) }}" class="category-card">
            <div class="card-icon"><i class="fas fa-graduation-cap"></i></div>
            <div class="card-content">
                <h2 class="card-title">ফ্রি এক্সাম</h2>
            </div>
            <div class="live-text">Free</div>
        </a> 
        @endif 
       

      

   

    </div>



    <!-- Subject Icons Section -->
    <h4> সাজেশন</h4>
    <div class="subject-icons-section">


        @forelse ($course->subjects as $subject)
        <a href="{{ url('/courses/' . urlencode($course->c_slug) . '/' . urlencode($subject->s_slug)) }}" class="subject-icon-card">
            <i class="fas fa-book"></i>
            <p>{{ $subject->s_title }}</p>
            <i class="fas fa-chevron-right"></i>
        </a>
    @empty
        <p>No subjects available for this course.</p>
    @endforelse

    </div>
    {{-- <a href="{{ route('subject.show', $subject->id) }}" --}}


    {{-- <h4> Exam</h4>
    <div class="category-cards">

        <a href="#" class="category-card">
            <div class="card-icon"><i class="fas fa-question-circle"></i></div>
            <div class="card-content">
                <h2 class="card-title">NTRCA Question</h2>
                <p class="card-subtitle">Questions for NTRCA exams</p>
            </div>

        </a>
        <a href="#" class="category-card">
            <div class="card-icon"><i class="fas fa-question-circle"></i></div>
            <div class="card-content">
                <h2 class="card-title">BCS Question</h2>
                <p class="card-subtitle">Questions for BCS exams</p>
            </div>

        </a>
        <a href="#" class="category-card">
            <div class="card-icon"><i class="fas fa-question-circle"></i></div>
            <div class="card-content">
                <h2 class="card-title">Primary Question</h2>
                <p class="card-subtitle">Questions for primary exams</p>
            </div>

        </a>
        <a href="#" class="category-card">
            <div class="card-icon"><i class="fas fa-question-circle"></i></div>
            <div class="card-content">
                <h2 class="card-title">Other Exam Question</h2>
                <p class="card-subtitle">Questions for various exams</p>
            </div>

        </a>
    </div>

 --}}

{{-- 
    <!-- Promotion Card -->
    <h4> Exam</h4>
    <div class="promotion-card">
        <div class="promotion-content">
            <h2 class="promotion-title">Special Offer</h2>
            <p class="promotion-description">Get 50% off on all courses for a limited time. Don't miss out!</p>
        </div>
        <div class="promotion-button">
            <a href="#" class="promotion-btn">Learn More</a>
        </div>
    </div>


    <!-- Blog Post Cards -->
    <h4> Exam</h4>
    <div class="blog-posts">
        <div class="blog-post-card">
            <div class="blog-post-content">
                <h2 class="blog-post-title">Blog Post Title 1</h2>
                <p class="blog-post-snippet">This is a short snippet or excerpt from the blog post. It gives a
                    preview of the content.</p>
                <a href="#" class="read-more-link">Read More</a>
            </div>
        </div>
        <div class="blog-post-card">
            <div class="blog-post-content">
                <h2 class="blog-post-title">Blog Post Title 2</h2>
                <p class="blog-post-snippet">This is another snippet or excerpt from a different blog post. It gives
                    a preview of the content.</p>
                <a href="#" class="read-more-link">Read More</a>
            </div>
        </div>

        <div class="blog-post-card">
            <div class="blog-post-content">
                <h2 class="blog-post-title">Blog Post Title 2</h2>
                <p class="blog-post-snippet">This is another snippet or excerpt from a different blog post. It gives
                    a preview of the content.</p>
                <a href="#" class="read-more-link">Read More</a>
            </div>
        </div>


        <!-- Add more blog-post-card elements as needed -->
    </div> --}}



    <!-- Social Media Cards -->
    <div class="social-media-cards">
        <div class="social-media-card facebook-card">
            <div class="social-media-icon"><i class="fab fa-facebook-f"></i></div>
            <div class="social-media-content">
                <h2 class="social-media-title">Join Our Facebook Group</h2>
            </div>
            <a href="#" class="social-media-btn">Join Now</a>
        </div>

        <div class="social-media-card whatsapp-card">
            <div class="social-media-icon"><i class="fab fa-whatsapp"></i></div>
            <div class="social-media-content">
                <h2 class="social-media-title">Join Our WhatsApp Group</h2>
            </div>
            <a href="#" class="social-media-btn">Join Now</a>
        </div>
    </div>




    <!-- Subscription Section -->
    @include('frontend.include.subcribe')

@include('frontend.include.coursefooter')



</main>



@endsection
{{-- @endauth
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
     
        {{-- <div class="form-container">
            <h1>সাইন একাউন্ট</h1> --}}

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
            {{-- <div class="google-signin">
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

@endguest --}}

