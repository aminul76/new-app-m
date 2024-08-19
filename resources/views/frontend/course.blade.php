@extends('frontend.master')
@section('style')
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








    <h4> Exam</h4>
    <div class="category-cards">




        <a href="#" class="category-card">
            <div class="card-icon"><i class="fas fa-calendar-day"></i></div>
            <div class="card-content">
                <h2 class="card-title">Live Exam</h2>
            </div>
            <div class="live-text">Live</div>
        </a>


        <a href="#" class="category-card">
            <div class="card-icon"><i class="fas fa-graduation-cap"></i></div>
            <div class="card-content">
                <h2 class="card-title">Free Exam</h2>
            </div>
            <div class="live-text">Free</div>
        </a>

        <a href="routine.html" class="category-card">
            <div class="card-icon"><i class="fas fa-calendar-check"></i></div>
            <div class="card-content">
                <h2 class="card-title">Routine Exam</h2>
            </div>
            <div class="live-text">Live</div>
        </a>

        <a href="#" class="category-card">
            <div class="card-icon"><i class="fas fa-question-circle"></i></div>
            <div class="card-content">
                <h2 class="card-title">NTRCA Question</h2>

            </div>

        </a>


    </div>



    <!-- Subject Icons Section -->
    <h4> Exam</h4>
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


    <h4> Exam</h4>
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





 @section('footerblade')
 <a href="index.html">
    <i class="fas fa-home"></i>
    <span class="footer-text">Home</span>
</a>
<a href="routine.html">
    <i class="fas fa-calendar-check"></i>
    <span class="footer-text">Routine</span>
</a>
     
 @endsection

</main>



@endsection

