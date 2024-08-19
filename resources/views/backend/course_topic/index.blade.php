@extends('backend.master')
@section('content')
    <h1>Courses with topics</h1>
    
    @foreach($courses as $course)
        <h3>{{ $course->c_title }}
            <a href="{{ route('admin.course-topic.edit', $course->id) }}">Edit</a>

        </h3>
        <ul>
            @foreach($course->topics as $topic)
                <li>{{ $topic->t_title }}</li>
            @endforeach
        </ul>
    @endforeach
    <a href="{{ route('admin.course-topic.create') }}">Assign topics to Course</a>
@endsection
