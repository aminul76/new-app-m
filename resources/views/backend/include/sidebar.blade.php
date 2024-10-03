<div class="sidebar">
    <div class="logo">
        <h2>Admin</h2>
    </div>
    <ul>
        <li><a href="#">Dashboard</a></li>

        <li><a href="{{ route('admin.courses.index') }}">Courses</a></li>
        <li>
            <a href="">Subject Item</a>
            <ul class="submenu">
                <li><a href="{{ route('admin.subjects.index') }}">Subjects</a></li>
                <li><a href="{{ route('admin.course-subject.index') }}">Course Subject</a></li>

                <li><a href="{{ route('admin.topics.index') }}">Topics</a></li>
                <li><a href="{{ route('admin.course-topic.index') }}">Course Topic</a></li>
                <li><a href="{{ route('admin.exams.index') }}">Exam</a></li>
                <li><a href="{{ route('admin.years.index') }}">Years</a></li>

            </ul>
        </li>

        <li>
            <a href="">Question</a>
            <ul class="submenu">
                <li><a href="{{ route('admin.questions.index') }}">Question</a></li>
                <li><a href="{{ route('admin.yearexam.index') }}">ImportQuestion</a></li>
                <li><a href="{{ route('admin.explan.index') }}">Import Q Explan </a></li>
                <li><a href="{{ route('admin.label.index') }}">Import Lebal Topic</a></li>
                <li><a href="{{ route('admin.options.index') }}">Option</a></li>

            </ul>
        </li>


        <li>
            <a href="">Model Test Generate</a>
            <ul class="submenu">
                <li><a href="{{ route('admin.model_tests.index') }}">Model test</a></li>


            </ul>
        </li>


        
        <li>
            <a href="">Subcribe</a>
            <ul class="submenu">
                <li><a href="{{ route('admin.course-subscribes.index') }}">Subcribe</a></li>


            </ul>
        </li>


        <li>
            <a href="">Settings</a>
            <ul class="submenu">
                <li><a href="{{ route('admin.settings.index') }}">Settings</a></li>


            </ul>
        </li>


        <li>
            <a href="">User</a>
            <ul class="submenu">
                <li><a href="{{ route('admin.fackuser.import.form') }}">Fack User</a></li>


            </ul>
        </li>

        <li>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; padding: 0;">
                  SingOUt
                </button>
            </form>
        </li>
        {{-- <li><a href="#">Reports</a></li>
        <li><a href="#">Logout</a></li> --}}

    </ul>
</div>
