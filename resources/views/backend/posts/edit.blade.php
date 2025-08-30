@extends('backend.master')
 @section('style')
 <!-- Summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
<!-- jQuery (required by Summernote) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Summernote JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>

    @endsection
@section('content')
    <h2>Edit Post</h2>

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{ $post->title }}" required><br><br>
        <textarea name="short_description" required>{{ $post->short_description }}</textarea><br><br>
        <input type="text" name="photolink" value="{{ $post->photolink }}"><br><br>
        <input type="file" name="photo"><br><br>
        <textarea id="summernote" name="description" placeholder="Full Description" required>{!!$post->description !!}</textarea><br><br>

       
        <button type="submit">Update</button>
    </form>
@endsection
 @section('pagescripts')
    <script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300,
            placeholder: 'Write the full description here...',
        });
    });
</script>
    @endsection