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
   
    @yield('content')
   
    
    @yield('js')



    <footer>
        <div class="footer-icons">
          @yield('footerblade')
            <a href="result.html">
                <i class="fas fa-chart-line"></i>
                <span class="footer-text">Results</span>
            </a>
            <a href="profile.html">
                <i class="fas fa-user"></i>
                <span class="footer-text">Profile</span>
            </a>
    
        </div>
    </footer>
    
</body>

</html>
