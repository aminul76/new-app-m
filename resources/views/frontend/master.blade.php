<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Cards</title>
    <link rel="stylesheet" href="{{asset('frontend/css/styles.css')}}">
    @yield('style')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('frontend/js/scripts.js')}}" defer></script>
</head>

<body>
   @include('frontend.include.header')
    @yield('content')
    @include('frontend.include.footer')
</body>

</html>
