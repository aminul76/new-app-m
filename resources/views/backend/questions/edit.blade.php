@extends('backend.master')

@section('content')
    <h1>Edit Question</h1>

    <form action="{{ route('admin.questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="subject_id">Subject:</label>
        <select name="subject_id" id="subject_id" required>
            <option value="">Select a Subject</option>
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}" {{ $question->subject_id == $subject->id ? 'selected' : '' }}>
                    {{ $subject->s_title }}
                </option>
            @endforeach
        </select>

        <label for="topic_id">Topic:</label>
        <select name="topic_id" id="topic_id" required>
            <option value="">Select a Topic</option>
            @foreach($topics as $topic)
                <option value="{{ $topic->id }}" {{ $question->topic_id == $topic->id ? 'selected' : '' }}>
                    {{ $topic->t_title }}
                </option>
            @endforeach
        </select>

        <label for="q_title">Title:</label>
        <input type="text" name="q_title" id="q_title" value="{{ $question->q_title }}" required>

        <label for="q_slug">Slug:</label>
        <input type="text" name="q_slug" id="q_slug" value="{{ $question->q_slug }}" required>

        <label for="q_explain">Explanation:</label>
        <textarea name="q_explain" id="q_explain" required>{{ $question->q_explain }}</textarea>

        <button type="submit">Update</button>
    </form>
@endsection
