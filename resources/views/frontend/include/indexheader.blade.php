<header>
    <div class="header-left">
        <div class="menu-icon" onclick="toggleMenu()"><i class="fas fa-bars"></i></div>
        <div class="logo">BD LIVE MCQ</div>
    </div>
    {{-- <div class="header-right">
        <a href="{{route('login')}}" class="sign-in-btn"><i class="fas fa-sign-in-alt"></i> Sign In</a>
    </div> --}}
</header>
<nav id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">BD LIVE MCQ</div>
        <div class="close-icon" onclick="toggleMenu()"><i class="fas fa-times"></i></div>
    </div>
    <ul>
      
     
      
        @foreach ($courses as $course)

        <li><a href="{{ url('/courses', $course->c_slug) }}"><i class="fas fa-star"></i> {{ $course->c_title }}</a></li>

      
    @endforeach
    </ul>
</nav>
