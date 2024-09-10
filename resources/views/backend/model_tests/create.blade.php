@extends('backend.master')

@section('content')
    <h1>Create Model Test</h1>
    <form action="{{ route('admin.model_tests.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}">
        </div>
        <div>
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}">
        </div>
        <div>
            <label for="course_id">Course</label>
            <select name="course_id" id="course_id">
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->c_title }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="status">Status</label>
            <input type="number" name="status" id="status" value="{{ old('status') }}">
        </div>
        <div class="form-group">
            <label for="m_description">Description</label>
            <textarea id="m_description" name="m_description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="mark">Mark</label>
            <input type="text" id="mark" name="mark" class="form-control" maxlength="255" required>
        </div>
        <div>
            <label for="start_date">Start Date</label>
            <input type="datetime-local" name="start_date" id="start_date" value="{{ old('start_date') }}">
        </div>
        <div>
            <label for="end_date">End Date</label>
            <input type="datetime-local" name="end_date" id="end_date" value="{{ old('end_date') }}">
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
