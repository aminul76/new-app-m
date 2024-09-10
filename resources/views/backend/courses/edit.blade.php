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
    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="c_title">Course Title</label>
            <input type="text" class="form-control" id="c_title" name="c_title" value="{{ old('c_title', $course->c_title) }}" required>
        </div>

        <div class="form-group">
            <label for="c_slug">Course Slug</label>
            <input type="text" class="form-control" id="c_slug" name="c_slug" value="{{ old('c_slug', $course->c_slug) }}" required>
        </div>

        <div class="form-group">
            <label for="c_description">Description</label>
            <textarea class="form-control" id="c_description" name="c_description">{{ old('c_description', $course->c_description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="c_colour">Color</label>
            <input type="text" class="form-control" id="c_colour" name="c_colour" value="{{ old('c_colour', $course->c_colour) }}">
        </div>

        <div class="form-group">
            <label for="c_image">Course Image</label>
            @if ($course->c_image)
                <div>
                    <img src="{{ asset('images/courseimage/' . $course->c_image) }}" alt="Current Image" class="img-fluid" style="max-width: 300px;">
                </div>
            @endif
            <input type="file" class="form-control-file" id="c_image" name="c_image">
            <small class="form-text text-muted">Leave blank if you do not want to change the image.</small>
        </div>

        <div class="form-group">
            <label for="c_seo_title">SEO Title</label>
            <input type="text" class="form-control" id="c_seo_title" name="c_seo_title" value="{{ old('c_seo_title', $course->c_seo_title) }}">
        </div>

        <div class="form-group">
            <label for="c_seo_image">SEO Image</label>
            @if ($course->c_seo_image)
                <div>
                    <img src="{{ asset('images/courseimage/' . $course->c_seo_image) }}" alt="Current SEO Image" class="img-fluid" style="max-width: 300px;">
                </div>
            @endif
            <input type="file" class="form-control-file" id="c_seo_image" name="c_seo_image">
            <small class="form-text text-muted">Leave blank if you do not want to change the SEO image.</small>
        </div>

        <div class="form-group">
            <label for="c_seo_description">SEO Description</label>
            <textarea class="form-control" id="c_seo_description" name="c_seo_description">{{ old('c_seo_description', $course->c_seo_description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="c_keyword">Keywords</label>
            <input type="text" class="form-control" id="c_keyword" name="c_keyword" value="{{ old('c_keyword', $course->c_keyword) }}">
        </div>

        <button type="submit">Update</button>
    </form>
@endsection
