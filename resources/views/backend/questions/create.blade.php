@extends('backend.master')

@section('content')
    <h1>Create Question</h1>

    <form action="{{ route('admin.questions.store') }}" method="POST">
        @csrf

        <label for="subject_id">Subject:</label>
        <select name="subject_id" id="subject_id" required>
            <option value="">Select a Subject</option>
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->s_title }}</option>
            @endforeach
        </select>

        <label for="topic_id">Topic:</label>
        <select name="topic_id" id="topic_id" required>
            <option value="">Select a Topic</option>
            @foreach($topics as $topic)
                <option value="{{ $topic->id }}">{{ $topic->t_title }}</option>
            @endforeach
        </select>

        <label for="q_title">Title:</label>
        <input type="text" name="q_title" id="q_title" required>

        <label for="q_slug">Slug:</label>
        <input type="text" name="q_slug" id="q_slug" required>

        <label for="q_explain">Explanation:</label>
        <textarea name="q_explain" id="q_explain" required></textarea>

        <button type="submit">Create</button>
    </form>
@endsection
