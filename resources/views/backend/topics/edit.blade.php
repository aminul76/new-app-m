@extends('backend.master')

@section('content')
    <h1>Subject Item Edit Topic</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.topics.update', $topic->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="t_title">Title:</label>
        <input type="text" name="t_title" id="t_title" value="{{ $topic->t_title }}">
        <label for="t_slug">Slug:</label>
        <input type="text" name="t_slug" id="t_slug" value="{{ $topic->t_slug }}">
        <label for="t_title">Subject:</label>
        <select name="subject_id" id="subject_id">

            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}" {{ $subject->id == $topic->subject_id ? 'selected' : '' }}>
                    {{ $subject->s_title }}
                </option>
            @endforeach
        </select>

        <label for="details">Details:</label>
        <textarea name="details" id="details" class="form-control">{{ $topic->details }}</textarea>

        <button type="submit">Update</button>
    </form>
@endsection

@section('pagescripts')
    {{-- Summernote CSS & JS --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#details').summernote({
                placeholder: 'Enter details here...',
                tabsize: 2,
                height: 200
            });
        });
    </script>
@endsection