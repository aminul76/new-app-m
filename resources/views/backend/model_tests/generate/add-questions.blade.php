@extends('backend.master')

@section('content')
<div class="container">
    <h2>Add Questions to Model Test: {{ $modelTest->title }}</h2>
    <p>Number of Questions: {{ $questionCount }}</p>
    
    <ul>

        @foreach ($results as $result)

              <p>  Subject:  {{$result->s_title }}  Question Count:  {{$result->question_count }} <br></p>



        @endforeach
    </ul>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.model-test.add-questions', $modelTest->id) }}" method="POST">
        @csrf

        <input type="hidden" name="model_test_id" value="{{$modelTest->id}}">
        <div class="form-group">
            <label for="subject_id">Select Subject:</label>
            <select name="subject_id" id="subject_id" class="form-control" required>
                <option value="">-- Select Subject --</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->s_title }}</option>
                @endforeach
            </select>
            @error('subject_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="topic_id">Select Topic:</label>
            <select name="topic_id" id="topic_id" class="form-control" required>
                <option value="">-- Select Topic --</option>
                <!-- Topics will be loaded via JavaScript based on the selected subject -->
            </select>
            @error('topic_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="question_ids">Select Questions:</label>
            <select name="question_ids[]" id="question_ids" class="form-control" multiple required>
                <!-- Questions will be loaded via JavaScript based on the selected topic -->
            </select>
            @error('question_ids')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add Questions</button>
    </form>
</div>

<script>
 document.getElementById('subject_id').addEventListener('change', function() {
    var subjectId = this.value;
    if (subjectId) {
        fetch(`/admin/get-topics/${subjectId}`)
            .then(response => response.json())
            .then(data => {
                var topicSelect = document.getElementById('topic_id');
                topicSelect.innerHTML = '<option value="">-- Select Topic --</option>';
                data.topics.forEach(function(topic) {
                    topicSelect.innerHTML += `<option value="${topic.id}">${topic.t_title}</option>`;
                });
            })
            .catch(error => console.error('Error fetching topics:', error));
    } else {
        // Clear topics if no subject is selected
        document.getElementById('topic_id').innerHTML = '<option value="">-- Select Topic --</option>';
    }
});
document.getElementById('topic_id').addEventListener('change', function() {
    var topicId = this.value;
    if (topicId) {
        fetch(`/admin/get-questions/${topicId}`)
            .then(response => response.json())
            .then(data => {
                var questionSelect = document.getElementById('question_ids');
                questionSelect.innerHTML = '';
                data.questions.forEach(function(question) {
                    questionSelect.innerHTML += `<option value="${question.id}">${question.q_title}</option>`;
                });
            });
    }
});


</script>
@endsection
