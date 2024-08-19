@extends('frontend.master')
@section('style')
@endsection





@section('content')

<div class="topic-header">
    <button class="back-button" onclick="javascript:history.back()">
      <span>&#x2190;</span> <!-- Left arrow for back -->
    </button>
    <h2 class="topic-title">অনুশীলন</h2>
  </div>

<main>







    <div class="subject-icons-section">


        @forelse ($topics as $topics)
        <a href="{{ route('topics.questions', [$course->id, $topics->topic_id]) }}" class="subject-icon-card">
            <i class="fas fa-book"></i>
            <p>{{ $topics->topic_name }}</p>
            @if ($subscription==null)
            <i class="fas fa-lock"></i>  
            @else
            <i class="fas fa-chevron-right"></i>   
            @endif
            
          
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

