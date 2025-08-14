@extends('backend.master')
@section('content')
    <h1>Edit Course topics</h1>
    <form action="{{ route('admin.course-topic.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="course_id">Course:</label>
            <select name="course_id" required >
                <option value="{{ $course->id }}">{{ $course->c_title }}</option>
            </select>
        </div>
        <div>
            <label for="topics">topics:</label>
            <select name="topics[]" multiple size="18" required>
                @foreach($topics as $topic)
                    <option value="{{ $topic->id }}"
                        @if(in_array($topic->id, $course->topics->pluck('id')->toArray())) selected @endif>
                        {{ $topic->t_title }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
