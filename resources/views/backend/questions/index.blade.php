@extends('backend.master')

@section('content')
    <h1>Questions</h1>

    <a href="{{ route('admin.questions.create') }}" style="margin-bottom: 20px; display: inline-block;">Create New Question</a>

<br>
    <a href="{{ route('admin.question.searchForm') }}" style="margin-bottom: 20px; display: inline-block;"> Question Surch</a>


    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <table id="dTable" class="display">
      <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
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
                    <td>{{ $question->q_slug }}</td>
                    <td>{{ $question->subject->s_title ?? 'N/A' }}</td>
                    <td>{{ $question->topic->t_title ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('admin.questions.edit', $question->id) }}">Edit</a>
                        <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this question?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
