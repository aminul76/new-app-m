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
    <form action="{{ route('question.search') }}" method="GET">
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
                @foreach ($questions as $question)
                    <tr>
                        <td>{{ $question->id }}</td>
                        <td>{{ $question->q_title }}</td>
                        <td>{{ $question->subject->s_title }}</td>
                        <td>{{ $question->topic->t_title }}</td>
                        <td>
                            <a href="{{ route('question.edit', $question->id) }}" class="btn btn-info">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        @if(request()->isMethod('get') && count($questions) === 0)
            <div class="alert alert-warning mt-4">
                No results found for your search.
            </div>
        @endif
    @endif
</div>
@endsection
