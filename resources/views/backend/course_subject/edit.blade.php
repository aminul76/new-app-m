@extends('backend.master')
@section('content')
    <h1>Edit Course Subjects</h1>
    <form action="{{ route('admin.course-subject.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="course_id">Course:</label>
            <select name="course_id" required >
                <option value="{{ $course->id }}">{{ $course->c_title }}</option>
            </select>
        </div>
        <div>
            <label for="subjects">Subjects:</label>
            <select name="subjects[]" multiple required>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}"
                        @if(in_array($subject->id, $course->subjects->pluck('id')->toArray())) selected @endif>
                        {{ $subject->s_title }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
