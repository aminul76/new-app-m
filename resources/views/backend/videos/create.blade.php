@extends('backend.master')

@section('content')
<h1>Create Video</h1>

<form action="{{ route('admin.videos.store') }}" method="POST">
    @csrf
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required><br>

    <label for="course_id">Course:</label>
    <select name="course_id" id="course_id">
        @foreach($courses as $course)
            <option value="{{ $course->id }}">{{ $course->c_title }}</option>
        @endforeach
    </select><br>
    <label for="video_link">Video Link:</label>
        <textarea name="video_link" id="video_link">{{ old('video_link') }}</textarea><br>

        <label for="pdf_link">PDF Link:</label>
        <textarea name="pdf_link" id="pdf_link">{{ old('pdf_link') }}</textarea><br>

        <label for="class_test_link">Class Test Link:</label>
        <textarea name="class_test_link" id="class_test_link">{{ old('class_test_link') }}</textarea><br>
        

    <label for="status">Status:</label>
    <input type="number" name="status" id="status" required><br>

    <label for="start_date">Start Date:</label>
    <input type="datetime-local" name="start_date" id="start_date" required><br>

    <label for="end_date">End Date:</label>
    <input type="datetime-local" name="end_date" id="end_date" required><br>

    <button type="submit">Create Video</button>
</form>
@endsection
