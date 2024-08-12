@extends('backend.master')

@section('content')
    <h1>Edit Model Test</h1>
    <form action="{{ route('admin.model_tests.update', $modelTest->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $modelTest->title) }}">
        </div>
        <div>
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $modelTest->slug) }}">
        </div>
        <div>
            <label for="course_id">Course</label>
            <select name="course_id" id="course_id">
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ $course->id == $modelTest->course_id ? 'selected' : '' }}>
                        {{ $course->c_title }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="status">Status</label>
            <input type="number" name="status" id="status" value="{{ old('status', $modelTest->status) }}">
        </div>
        <div>
            <label for="start_date">Start Date</label>
            <input type="datetime-local" name="start_date" id="start_date" value="{{ old('start_date', $modelTest->start_date->format('Y-m-d\TH:i')) }}">
        </div>
        <div>
            <label for="end_date">End Date</label>
            <input type="datetime-local" name="end_date" id="end_date" value="{{ old('end_date', $modelTest->end_date->format('Y-m-d\TH:i')) }}">
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
