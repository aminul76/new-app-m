@extends('backend.master')
@section('content')
    <h1>Assign topics to Course</h1>
    <form action="{{ route('admin.course-topic.store') }}" method="POST">
        @csrf
        <div>
            <label for="course_id">Course:</label>
            <select name="course_id" required>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->c_title }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="topics">topics:</label>
            <select name="topics[]" multiple required>
                @foreach($topics as $topic)
                    <option value="{{ $topic->id }}">{{ $topic->t_title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Assign</button>
    </form>
@endsection
