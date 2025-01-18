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
                <option value="{{ $topic->id }}" {{ $question->topic_id == $topic->id ? 'selected' : '' }} data-subject="{{ $topic->subject_id }}">
                    {{ $topic->t_title }}
                </option>
            @endforeach
        </select>

        <label for="years">Select Years:</label>
        <select name="years[]" id="years" multiple>
            @foreach($years as $year)
                <option value="{{ $year->id }}" 
                        @if(in_array($year->id, $question->years->pluck('id')->toArray()))
                            selected
                        @endif>
                    {{ $year->y_title }}
                </option>
            @endforeach
        </select>

        <label for="exams">Select exams:</label>
        <select name="exams[]" id="exams" multiple>
            @foreach($exams as $exam)
                <option value="{{ $exam->id }}" 
                        @if(in_array($exam->id, $question->exams->pluck('id')->toArray()))
                            selected
                        @endif>
                    {{ $exam->e_title }}
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

    <script>
        // JavaScript to filter topics based on the selected subject
        document.addEventListener('DOMContentLoaded', function() {
            const subjectSelect = document.getElementById('subject_id');
            const topicSelect = document.getElementById('topic_id');
            const allTopics = Array.from(topicSelect.options);
            const selectedSubjectId = subjectSelect.value;

            // Show topics based on selected subject
            subjectSelect.addEventListener('change', function() {
                const selectedSubject = subjectSelect.value;
                topicSelect.innerHTML = '<option value="">Select a Topic</option>';

                allTopics.forEach(option => {
                    if (option.getAttribute('data-subject') === selectedSubject || selectedSubject === '') {
                        topicSelect.appendChild(option);
                    }
                });
            });

            // Trigger change event to load topics for the initially selected subject
            if (selectedSubjectId) {
                subjectSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
@endsection
