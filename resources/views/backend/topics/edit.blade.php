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
        <button type="submit">Update</button>
    </form>
@endsection
