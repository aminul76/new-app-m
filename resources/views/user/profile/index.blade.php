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
<link rel="stylesheet" href="{{asset('frontend/css/profile.css')}}">
<style>
    /* Modal styles */
.modal {
display: none;
position: fixed;
bottom: 50px;
left: 0;
width: 100%;
height: auto;
background-color: #fff;
z-index: 1000;
}

.modal-content {
background-color: #f1f1f1;
margin: 20px auto;
padding: 20px;
border-radius: 5px;
width: 80%;
max-width: 500px;
position: relative;
}

.close-btn {
position: absolute;
top: 10px;
right: 15px;
font-size: 24px;
cursor: pointer;
}

form {
display: flex;
flex-direction: column;
}

form label {
margin: 10px 0 5px;
}

form input, form textarea {
padding: 10px;
margin-bottom: 15px;
border: 1px solid #ccc;
border-radius: 5px;
}

form button {
padding: 10px;
background-color: #007bff;
border: none;
color: #fff;
border-radius: 5px;
cursor: pointer;
}

form button:hover {
background-color: #0056b3;
}

</style>
@endsection
@section('content')
@include('frontend.include.header')
<main>


    @php
    $user = Auth::user();
    use Carbon\Carbon;
    $subscription = \App\Models\CourseSubscribe::where('user_id', $user->id)
    ->where('course_id', $course->id)
    ->where(function ($query) {
        $query->whereNull('expires_at')
              ->orWhere('expires_at', '>=', Carbon::now());
    })
    ->first();
  @endphp
    <div class="routine-card">

        <div class="profile">
            <div class="profile-info">
                {{-- <h1>Aminul Islam    <button id="openModalBtn"><i class="fas fa-edit"></i></button></h1> --}}
               
                <h1>Name: {{$user->name}}</h1>
                <p>Eamail:{{$user->email}} </i></p>

                @if ($subscription)
                <h3>{{$course->c_title}} কোর্স একটিভ আছে</h3> 
                @else
                <h3>কোর্স একটিভ নাই</h3> 
                @endif
                

            </div>
        </div>
    </div>
    <div class="no-package">
        {{-- কোন একটিভ প্যাকেজ নাই --}}
    </div>

    <div class="routine-card">
        <div class="stats">
            <h2>পরিসংখ্যান (লাইভ এক্সাম)</h2>
         
           
            <h2>পরীক্ষার পরিসংখ্যান</h2>
            <div class="stat">
                <span class="stat-label">মোট প্রশ্ন</span>
                <span>{{$totalmarks}}টি</span>
            </div>

            <div class="stat">
                <span class="stat-label">সঠিক</span>
                <span>{{$totalCorrectAnswers}}টি ({{number_format($correct)}})%</span>
            
            </div>
            <div class="stat">
              
                <div class="stat-bar">
                    <div style="width: {{$correct}}%;"></div>
                </div>
            </div>




            <div class="stat">
                <span class="stat-label">ভুল</span>
                <span>{{$totalinCorrectAnswers}}টি ({{number_format($incorrect)}})%</span>
                
            </div>
            <div class="stat">
               
                <div class="stat-bar">
                    <div style="width: {{$incorrect}}%;"></div>
                </div>
            </div>
            <div class="stat">
                <span class="stat-label">অনুত্তরিত</span>
                <span>{{$totalmarks-$totalCorrectAnswers-$totalinCorrectAnswers}}টি ({{number_format(100-$correct-$incorrect)}}%)</span>
               
               
            </div>
            <div class="stat">
               
               
                <div class="stat-bar">
                    <div style="width: {{100-$correct-$incorrect}}%;"></div>
                </div>
            </div>
        </div>
    </div>

   
 

<!-- Modal -->
<div id="myModal" class="modal">
<div class="modal-content">
    <span class="close-btn">&times;</span>
    <h2>Update Profile</h2>
    <form>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="text">Number:</label>
        <input type="text" id="name" name="name" required>

        
        <button type="submit">Update</button>
    </form>
</div>
</div>


@include('frontend.include.subcribe')
@include('frontend.include.coursefooter')

</main>



@endsection
@section('js')
<script>
    document.getElementById('openModalBtn').addEventListener('click', function() {
    document.getElementById('myModal').style.display = 'block';
});

document.querySelector('.close-btn').addEventListener('click', function() {
    document.getElementById('myModal').style.display = 'none';
});

window.addEventListener('click', function(event) {
    if (event.target == document.getElementById('myModal')) {
        document.getElementById('myModal').style.display = 'none';
    }
});

</script>
    
@endsection
