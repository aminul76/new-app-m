<!DOCTYPE html>
<html lang="en">
@php
    $setting = \App\Models\Setting::first();
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   @yield('seo')

    <link rel="stylesheet" href="{{asset('frontend/css/styles.css')}}">
   

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('frontend/js/scripts.js')}}" defer></script>

    <link rel="icon" href="{{ asset('images/siteimage/' . $setting->site_favicon) }}" type="image/x-icon">

    @yield('style')


</head>

<body>
   
    @yield('content')
   
    
    @yield('js')



   
    
</body>

</html>
