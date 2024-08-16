@extends('backend.master')
@section('content')
    <h1>Courses with Subjects</h1>
    @foreach($courses as $course)
        <h3>{{ $course->c_title }}
            <a href="{{ route('admin.course-subject.edit', $course->id) }}">Edit</a>

        </h3>
        <ul>
            @foreach($course->subjects as $subject)
                <li>{{ $subject->s_title }}</li>
            @endforeach
        </ul>
    @endforeach
    <a href="{{ route('admin.course-subject.create') }}">Assign Subjects to Course</a>
@endsection
