@extends('frontend.master')
@section('style')
<link rel="stylesheet" href="{{asset('frontend/css/main.css')}}">
@endsection
@section('content')
@include('frontend.include.header')
<main>
    <!-- Title Card -->
    <div class="title-card">
        <h1>Title Card</h1>
        <p>This card is always displayed as one.</p>
    </div>

    <!-- Category Cards -->




    <!-- Category Cards -->

    <div class="course-body">
        @foreach ($courses as $course)
        <a class="course-card running" href="{{ url('/courses', $course->c_slug) }}" style="background: linear-gradient(135deg, #3a7bd5, #00d2ff); /* Blue to Purple Gradient */">
            <img src="{{asset('frontend/image/ntrca.png')}}" alt="ABC Blocks">
            <h3>ডেইলি মডেল টেস্ট (মার্কস: ৫০)</h3>
            <p>সময়: ২০ মিনিট</p>
        </a>
    @endforeach
    </div>






<h4> Exam</h4>
<div class="category-cards">




<a href="#" class="category-card">
    <div class="icon-container">
        <img src="{{asset('frontend/image/bcs.png')}}" alt="Icon" class="icon-image">
    </div>
    <div class="card-content">
        <h2 class="card-title">বিসিএস</h2>
    </div>

</a>


<a href="#" class="category-card">
    <div class="icon-container">
        <img src="{{asset('frontend/image/ntrca.png')}}" alt="Icon" class="icon-image">
    </div>
        <div class="card-content">
            <h2 class="card-title">এনটিআরসি</h2>
        </div>
    </a>

    <a href="routine.html" class="category-card">
        <div class="icon-container">
            <img src="{{asset('frontend/image/primary.png')}}" alt="Icon" class="icon-image">
        </div>
        <div class="card-content">
            <h2 class="card-title">প্রাইমারি</h2>
        </div>

    </a>

    <a href="#" class="category-card">
        <div class="card-icon"><i class="fas fa-question-circle"></i></div>
        <div class="card-content">
            <h2 class="card-title">NTRCA Question</h2>

        </div>

    </a>


</div>








<!-- Promotion Card -->

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
        <p class="blog-post-snippet">This is a short snippet or excerpt from the blog post. It gives a preview of the content.</p>
        <a href="#" class="read-more-link">Read More</a>
    </div>
</div>
<div class="blog-post-card">
    <div class="blog-post-content">
        <h2 class="blog-post-title">Blog Post Title 2</h2>
        <p class="blog-post-snippet">This is another snippet or excerpt from a different blog post. It gives a preview of the content.</p>
        <a href="#" class="read-more-link">Read More</a>
    </div>
</div>

<div class="blog-post-card">
    <div class="blog-post-content">
        <h2 class="blog-post-title">Blog Post Title 2</h2>
        <p class="blog-post-snippet">This is another snippet or excerpt from a different blog post. It gives a preview of the content.</p>
        <a href="#" class="read-more-link">Read More</a>
    </div>
</div>


<!-- Add more blog-post-card elements as needed -->
</div>



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
<div class="subscription-section">
<h2 class="subscription-title">Subscribe to our newsletter</h2>
<button class="subscription-b-btn">Subscribe</button>
</div>




</main>
@endsection

