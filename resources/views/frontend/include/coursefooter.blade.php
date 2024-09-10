<footer>
    <div class="footer-icons">
        <a href="{{ url('/courses', $course->c_slug) }}">
            <i class="fas fa-home"></i>
            <span class="footer-text">Home</span>
        </a>
        <a href="{{ url('/model-tests/current', $course->c_slug) }}">
            <i class="fas fa-calendar-check"></i>
            <span class="footer-text">Routine</span>
        </a>
             
        <a href="{{ url('/modelresultlist', $course->c_slug) }}">
            <i class="fas fa-chart-line"></i>
            <span class="footer-text">Results</span>
        </a>
        <a href="{{ url('/profile', $course->c_slug) }}">
            <i class="fas fa-user"></i>
            <span class="footer-text">Profile</span>
        </a>

    </div>
</footer>