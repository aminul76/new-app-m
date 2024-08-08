@extends('backend.master')


@section('content')
    <h1>Subject Item->Edit Exam</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.exams.update', $exam->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="e_title">Title:</label>
        <input type="text" name="e_title" id="e_title" value="{{ $exam->e_title }}">
        <label for="e_slug">Slug:</label>
        <input type="text" name="e_slug" id="e_slug" value="{{ $exam->e_slug }}">
        <button type="submit">Update</button>
    </form>
@endsection
