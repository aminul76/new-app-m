@extends('backend.master')

@section('content')
    <h1>Create Course</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="c_title">Course Title</label>
            <input type="text" class="form-control" id="c_title" name="c_title" value="{{ old('c_title') }}" required>
        </div>

        <div class="form-group">
            <label for="c_slug">Course Slug</label>
            <input type="text" class="form-control" id="c_slug" name="c_slug" value="{{ old('c_slug') }}" required>
        </div>

        <div class="form-group">
            <label for="c_description">Description</label>
            <textarea class="form-control" id="c_description" name="c_description">{{ old('c_description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="c_colour">Color</label>
            <input type="text" class="form-control" id="c_colour" name="c_colour" value="{{ old('c_colour') }}">
        </div>

        <div class="form-group">
            <label for="c_image">Course Image</label>
            <input type="file" class="form-control-file" id="c_image" name="c_image">
        </div>

        <div class="form-group">
            <label for="c_seo_title">SEO Title</label>
            <input type="text" class="form-control" id="c_seo_title" name="c_seo_title" value="{{ old('c_seo_title') }}">
        </div>

        <div class="form-group">
            <label for="c_seo_image">SEO Image</label>
            <input type="file" class="form-control-file" id="c_seo_image" name="c_seo_image">
        </div>

        <div class="form-group">
            <label for="c_seo_description">SEO Description</label>
            <textarea class="form-control" id="c_seo_description" name="c_seo_description">{{ old('c_seo_description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="c_keyword">Keywords</label>
            <input type="text" class="form-control" id="c_keyword" name="c_keyword" value="{{ old('c_keyword') }}">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
