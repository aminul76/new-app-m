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


        <div class="form-group">
            <label for="m_description">Description</label>
            <textarea id="m_description" name="m_description" class="form-control" rows="4" required>{{ old('m_description', $modelTest->m_description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="mark">Mark</label>
            <input type="text" id="mark" name="mark" class="form-control" maxlength="255" value="{{ old('mark', $modelTest->mark) }}" required>
        </div>

        <div class="form-group">
            <label for="set_time">set_time</label>
            <input type="text" id="set_time" name="set_time" class="form-control" maxlength="255" value="{{ old('set_time', $modelTest->set_time) }}" required>
        </div>

        <div>
            <label for="status">Status</label>
            <p>স্টাটাস 1 দিলে ডেইলিতে সো করবে । 2 দিলে সো করবে না। 3 দিলে free exam হবে  পপ আপে ডেটা দিবে। তা সেভ হবে। 4 দিলে ফ্রি এক্সাম হবে । 5 হলে পেইড পরিক্ষা একবার দিতে পারবে  </p>
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
