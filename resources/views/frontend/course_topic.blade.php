@extends('frontend.master')
@section('style')
@endsection



<div class="topic-header">
    <button class="back-button" onclick="javascript:history.back()">
      <span>&#x2190;</span> <!-- Left arrow for back -->
    </button>
    <h2 class="topic-title">অনুশীলন</h2>
  </div>



@section('content')

<main>







    <div class="subject-icons-section">


        @forelse ($topics as $topics)
        <a href="{{ url('/courses/' . urlencode($topics->t_slug) . '/' . urlencode($topics->t_slug)) }}" class="subject-icon-card">
            <i class="fas fa-book"></i>
            <p>{{ $topics->t_title }}</p>
            <i class="fas fa-lock"></i>
        </a>
    @empty
        <p>No subjects available for this course.</p>
    @endforelse

    </div>



    <!-- Subscription Section -->
    <div class="subscription-section">
        <h2 class="subscription-title">Subscribe to our newsletter</h2>
        <button class="subscription-b-btn">Subscribe</button>
    </div>




</main>



@endsection

