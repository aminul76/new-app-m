@auth
@extends('frontend.master')

@section('style')
<style>
    



h2 {
    font-size: 20px;
    margin-bottom: 10px;
    text-align: center;
}

.payment-header {
    margin-bottom: 20px;
    display:flex;
    justify-content: center;
}
.pay-container{
   
    border: none;
    padding: 1px;
    width: 100%;
    font-size: 18px;
    position: fixed;
    bottom: 75px;
    right: 0;
    left: 0;
    border-radius: 0;
    cursor: pointer;
    z-index: 1000;
    height: 25%;
}


.payment-header button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px;
    width: 100%;
    border-radius: 20px;
    font-size: 16px;
    cursor: pointer;
}
@media (max-width: 300px) {
    .payment-header button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px;
    width: 100%;
    border-radius: 20px;
    font-size: 16px;
    cursor: pointer;
}
}
@media (max-width: 600px) {
    .payment-header button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px;
    width: 100%;
    border-radius: 20px;
    font-size: 16px;
    cursor: pointer;
}
}

.payment-header button.active {
    background-color: #007bff;
    color: white;
}

.payment-options {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
    gap: 10px;
}

.payment-option {
    width: 100px;
    cursor: pointer;
}

.payment-option img {
    position: relative;
    width: 100%;
    max-width: 168px;
    height: 60px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    /* cursor: pointer; */
    border: 1px solid #aaafb2;
    background: #ffffff;
}

.pay-section {
    margin-top: 20px;
}

.pay-btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 15px;
    width: 100%;  /* Full width button */
    font-size: 18px;
    position: fixed; /* Make the button fixed */
    bottom: 0; /* Align it to the bottom */
    left: 0; /* Make sure it's aligned with the left edge */
    border-radius: 0; /* No border radius for full-width button */
    cursor: pointer;
    z-index: 1000; /* Ensure it's above all other elements */
}

.pay-btn:hover {
    background-color: #0056b3;
}
.main-container {
        border-radius: 10px;
        margin: auto;
        width: 400px;
        height: 100%;
        background-color: #ffffff;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 0px 0px 34px -12px #615f5f;
    }

    .package-info {
   
        padding: 10px;
        max-height: 55%;
    overflow-y: auto; /* Enable vertical scrolling */
    text-align: justify;
}


    @media (max-width: 300px) {
        .main-container {
        border-radius: 10px;
        margin: auto;
        width: 100%;
        height: 100%;
        background-color: #ffffff;
        position: absolute;
       
        transform: translate(-50%, -50%);
        box-shadow: 0px 0px 34px -12px #615f5f;
    }

}
@media (max-width: 600px) {
    .main-container {
        border-radius: 10px;
        margin: auto;
        width: 100%;
        height: 100%;
        background-color: #ffffff;
        position: absolute;
      
        transform: translate(-50%, -50%);
        box-shadow: 0px 0px 34px -12px #615f5f;
    }

}


</style>
@endsection





@section('content')



<main>
    <div class="main-container">

        <div class="topic-header">
            <button class="back-button" onclick="javascript:history.back()">
              <span>&#x2190;</span> <!-- Left arrow for back -->
            </button>
            <h4 class="topic-title">{{ $course->c_title}}</h4>
        </div>
  <!-- Package Information Section -->
  <div class="package-info">
  {!!$course->c_subcribe_details!!}
    </div>




        <!-- Payment Method Header -->
<div class="sub-container">

    <div class="pay-container">
        <h2>Payment Method</h2>
        
        <!-- Mobile Banking Section -->
        <div class="payment-header">
            <button class="active">মোবাইল ব্যাংকিং</button>
        </div>

        <!-- Payment Options -->
        <div class="payment-options">
            <a href="{{ url('author/subcribe/tnxid',$course->id) }}" class="payment-option">
                <img src="{{asset('frontend/image/bkash.png')}}" alt="bKash">
            </a>
            <a href="{{ url('author/subcribe/tnxid',$course->id) }}" class="payment-option">
                <img src="{{asset('frontend/image/nagad.png')}}" alt="Nagad">
            </a>
        </div>

        <!-- Pay Button -->
        <div class="pay-section">
            <button class="pay-btn">Pay ৳{{$course->c_price}}</button>
        </div>
    </div>
</div>



   

    </div>


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



