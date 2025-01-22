@extends('backend.master')

@section('content')
<div class="container">
    <h2>Search Questions</h2>

    <!-- Displaying any validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Search Form -->
    <form action="{{ route('admin.question.search') }}" method="GET">
        <div class="form-group">
            <label for="subject_id">Select Subject</label>
            <select class="form-control" id="subject_id" name="subject_id">
                <option value="">Select Subject</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                        {{ $subject->s_title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="topic_id">Select Topic</label>
            <select class="form-control" id="topic_id" name="topic_id">
                <option value="">Select Topic</option>
                @foreach ($topics as $topic)
                    <option value="{{ $topic->id }}" {{ old('topic_id') == $topic->id ? 'selected' : '' }}>
                        {{ $topic->t_title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="q_title">Question Title</label>
            <input type="text" class="form-control" id="q_title" name="q_title" value="{{ old('q_title') }}" placeholder="Enter question title">
        </div>

        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <!-- Search Results -->
    @if (isset($questions) && $questions->isNotEmpty())
        <h3 class="mt-4">Search Results:</h3>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Question Title</th>
                    <th>Subject</th>
                    <th>Topic</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <form action="{{ route('admin.questions.bulkUpdate.update') }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Add this to make the form a PUT request -->
                    
                    @foreach ($questions as $question)
                    <td>{{ $question->id }}</td>
    <td>{{ $question->q_title }}</td>
                    <td>
                        <label for="subject_id_{{ $question->id }}">Subject:</label>
                        <select name="questions[{{ $question->id }}][subject_id]" id="subject_id_{{ $question->id }}" class="subject-select" data-question-id="{{ $question->id }}" required>
                            <option value="">Select a Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ $question->subject_id == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->s_title }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <label for="topic_id_{{ $question->id }}">Topic:</label>
                        <select name="questions[{{ $question->id }}][topic_id]" id="topic_id_{{ $question->id }}" required>
                            <option value="">Select a Topic</option>
                            @foreach($topics as $topic)
                                @if ($topic->subject_id == $question->subject_id)
                                    <option value="{{ $topic->id }}" {{ $question->topic_id == $topic->id ? 'selected' : '' }}>
                                        {{ $topic->t_title }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                            <td>
                               
                            </td>
                        </tr>
                    @endforeach
                
                    <button type="submit">Update All</button>
                </form>
            </tbody>
        </table>
    @else
      
    @endif
</div>


<script>
    // Function to update the topics based on the selected subject
    document.addEventListener("DOMContentLoaded", function () {
        // When subject is selected
        document.querySelectorAll('.subject-select').forEach(function (select) {
            select.addEventListener('change', function () {
                const questionId = this.getAttribute('data-question-id');
                const subjectId = this.value;
                const topicSelect = document.getElementById('topic_id_' + questionId);

                // Fetch topics for the selected subject via AJAX
                if (subjectId) {
                    fetch(`/get-topics/get-t/get-s/s/p/${subjectId}`)
                        .then(response => response.json())
                        .then(data => {
                            let options = '<option value="">Select a Topic</option>';
                            data.topics.forEach(function (topic) {
                                options += `<option value="${topic.id}">${topic.t_title}</option>`;
                            });
                            topicSelect.innerHTML = options;
                        })
                        .catch(error => console.error('Error fetching topics:', error));
                } else {
                    topicSelect.innerHTML = '<option value="">Select a Topic</option>';
                }
            });
        });
    });
</script>

@endsection
