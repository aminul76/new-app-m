@extends('backend.master')

@section('content')
    <h1>Edit Subject</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.subjects.update', $subject->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="s_title">Title:</label>
        <input type="text" name="s_title" id="s_title" value="{{ $subject->s_title }}">
        <label for="s_slug">Slug:</label>
        <input type="text" name="s_slug" id="s_slug" value="{{ $subject->s_slug }}">
        <button type="submit">Update</button>
    </form>
@endsection
