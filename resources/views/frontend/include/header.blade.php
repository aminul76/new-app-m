<header>
    <div class="header-left">
        <div class="menu-icon" onclick="toggleMenu()"><i class="fas fa-bars"></i></div>
        <div class="logo">LIVE EXAM</div>
    </div>
    {{-- <div class="header-right">
        <a href="{{route('login')}}" class="sign-in-btn"><i class="fas fa-sign-in-alt"></i> Sign In</a>
    </div> --}}
</header>
<nav id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">LIVE EXAM</div>
        <div class="close-icon" onclick="toggleMenu()"><i class="fas fa-times"></i></div>
    </div>
    <ul>
        <li><a href="{{ url('/courses', $course->c_slug) }}"><i class="fas fa-home"></i> হোম</a></li>
        <li><a href="{{ url('/model-tests/current', $course->c_slug) }}"><i class="fas fa-clock"></i> রুটিন এক্সাম</a></li>
        <li><a href="{{ url('/modelresultlist', $course->c_slug) }}"><i class="fas fa-chart-line"></i> রেজাল্ট </a></li>
        <li><a href="{{ url('/profile', $course->c_slug) }}"><i class="fas fa-user"></i> প্রোফাইল </a></li>
        
        <li>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; padding: 0;">
                    <i class="fas fa-sign-out-alt"></i> সাইন আউট
                </button>
            </form>
        </li>

    </ul>
</nav>
