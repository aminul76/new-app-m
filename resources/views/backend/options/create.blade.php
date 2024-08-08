@extends('backend.master')

@section('content')
    <h1>Create Option</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.options.store') }}" method="POST">
        @csrf
        <label for="question_id">Question:</label>
        <select name="question_id" id="question_id">
            @foreach ($questions as $question)
                <option value="{{ $question->id }}">{{ $question->q_title }}</option>
            @endforeach
        </select>
        <label for="p_title">Title:</label>
        <input type="text" name="p_title" id="p_title">
        <label for="is_correct">Is Correct:</label>
        <input type="checkbox" name="is_correct" id="is_correct" value="1">
        <br>
        <button type="submit">Create</button>
    </form>
@endsection
