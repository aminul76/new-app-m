@extends('backend.master')
@section('content')
    <h1>Assign Subjects to Course</h1>
    <form action="{{ route('admin.course-subject.store') }}" method="POST">
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
            <label for="subjects">Subjects:</label>
            <select name="subjects[]" multiple required>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->s_title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Assign</button>
    </form>
@endsection
