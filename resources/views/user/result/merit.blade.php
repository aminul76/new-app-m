
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
<link rel="stylesheet" href="{{asset('frontend/css/mark.css')}}">

@endsection
@section('content')
@include('frontend.include.header')
<main>
  

    <div class="topic-header">
    <button class="back-button" onclick="javascript:history.back()">
        <span>&#x2190;</span> <!-- Left arrow for back -->
    </button>
    <h2 class="topic-title">মেধা তালিকা</h2>
</div>


    
    <div class="container-mark-div">
        <div class="container-mark">
          
           
            <div class="table-responsive">
                <table class="mark-sheet">
                    <thead>
                        <tr>
                            <th>নাম</th>
                            <th>সঠিক</th>
                            <th>ভুল</th>
                            <th>মার্ক</th>
                        </tr>
                    </thead>
                    <tbody>
                   
                        <tr>
                            <td>{{ $userrecord->user->name }}</td>
                            <td>{{ $userrecord->correct_answers_count }}</td>
                            <td>{{ $userrecord->incorrect_answers_count }}</td>
                            <td>{{ $userrecord->correct_answers_count - $userrecord->incorrect_answers_count*.25 }}</td>
                        </tr>
                        @foreach ($allrecords as $allrecord)
                        <tr>
                            <td>{{ $allrecord->user->name }}</td>
                            <td>{{ $allrecord->correct_answers_count }}</td>
                            <td>{{ $allrecord->incorrect_answers_count }}</td>
                            <td>{{ $allrecord->correct_answers_count - $allrecord->incorrect_answers_count*.25 }}</td>
                        </tr>
                        @endforeach

                        @foreach($allfeckrecoards as $allfeckrecoard)
                            <tr>
                                <td>{{ $allfeckrecoard->fackusers->f_name }}</td>
                                <td>{{$allfeckrecoard->correct_answers_count}}</td>
                                <td>{{$allfeckrecoard->incorrect_answers_count}}</td>
                                <td>{{ $allfeckrecoard->correct_answers_count - $allfeckrecoard->incorrect_answers_count*.25 }}</td>

                             </tr>
                              
                      
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>





@include('frontend.include.coursefooter')



</main>



@endsection
