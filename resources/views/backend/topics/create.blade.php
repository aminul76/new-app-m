@extends('backend.master')

@section('content')
    <h1>Subject Item Create Topic</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.topics.store') }}" method="POST">
        @csrf
        <label for="t_title">Title:</label>
        <input type="text" name="t_title" id="t_title">
        <label for="t_slug">Slug:</label>
        <input type="text" name="t_slug" id="t_slug">
        <label for="t_slug">Subject:</label>
        <select name="subject_id" id="subject_id">
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->s_title }}</option>
            @endforeach
        </select>
        <button type="submit">Create</button>
    </form>
@endsection
