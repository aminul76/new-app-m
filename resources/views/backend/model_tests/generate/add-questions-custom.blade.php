@extends('backend.master')

@section('content')
<div class="container">
    <a href="{{ route('admin.model-test.add-questions.form', $modelTest->id) }}" class="btn btn-secondary mb-3">
        Add Question
    </a>
    <p>  যে গুলো প্রশ্ন টপিক  এড করা নাই সেগুলো মডেলটেস্টে এড করতে হলে ইরোর দিবে </p>
    <h2>Add Questions to Model Test: <strong>{{ $modelTest->title }}</strong></h2>
    <p><strong>Total Questions:</strong> {{ $questionCount }}</p>

    {{-- Subject Counts --}}
    <div class="mb-3">
        <h5>Subjects in this Test:</h5>
        <ul>
            @foreach ($results as $result)
                <li>{{ $result->s_title }} — <strong>{{ $result->question_count }} questions</strong></li>
            @endforeach
        </ul>
    </div>

    {{-- Topic Counts --}}
    <div class="mb-4">
        <h5>Topics in this Test:</h5>
        <ul>
            @foreach ($topicscouts as $topicscout)
                <li>{{ $topicscout->t_title }} — <strong>{{ $topicscout->question_count }} questions</strong></li>
            @endforeach
        </ul>
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('admin.model-test.add-questions.custom', $modelTest->id) }}" method="POST">
        @csrf
        <input type="hidden" name="model_test_id" value="{{ $modelTest->id }}">

        {{-- Level Dropdown --}}
        <div class="form-group">
            <label for="level_id">Select Level (Import):</label>
            <select id="level_id" class="form-control" required>
                <option value="">-- Select Level --</option>
                @foreach ($levels as $level)
                    <option value="{{ $level->id }}">{{ $level->i_title }}</option>
                @endforeach
            </select>
        </div>

        {{-- Questions Multi-select --}}
        <div class="form-group mt-3">
            <label for="question_ids">Select Questions:</label>
            <select name="question_ids[]" id="question_ids" class="form-control" multiple required size="15">
                {{-- Questions will be loaded via JavaScript --}}
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Add Selected Questions</button>
    </form>
</div>

{{-- JavaScript --}}
<script>
    document.getElementById('level_id').addEventListener('change', function () {
        const importId = this.value;
        const questionSelect = document.getElementById('question_ids');

        if (importId) {
            fetch(`/admin/get-questions-by-level/${importId}`)
                .then(res => res.json())
                .then(data => {
                    questionSelect.innerHTML = '';
                    if (data.questions && data.questions.length > 0) {
                        data.questions.forEach(q => {
                            questionSelect.innerHTML += `<option value="${q.id}">${q.q_title}</option>`;
                        });
                    } else {
                        questionSelect.innerHTML = '<option disabled>No questions found for this level.</option>';
                    }
                })
                .catch(error => {
                    console.error('Error loading questions:', error);
                    questionSelect.innerHTML = '<option disabled>Error loading questions.</option>';
                });
        } else {
            questionSelect.innerHTML = '';
        }
    });
</script>
@endsection
