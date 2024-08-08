@extends('backend.master')

@section('content')
    <h1>Create Subject</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.subjects.store') }}" method="POST">
        @csrf
        <label for="s_title">Title:</label>
        <input type="text" name="s_title" id="s_title">
        <label for="s_slug">Slug:</label>
        <input type="text" name="s_slug" id="s_slug">
        <button type="submit">Create</button>
    </form>
@endsection
