@extends('backend.master')

@section('content')
    <h1>Edit Course</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="c_title">Title:</label>
        <input type="text" name="c_title" id="c_title" value="{{ $course->c_title }}">
        <label for="c_slug">Slug:</label>
        <input type="text" name="c_slug" id="c_slug" value="{{ $course->c_slug }}">
        <button type="submit">Update</button>
    </form>
@endsection
