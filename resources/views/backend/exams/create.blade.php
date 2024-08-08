@extends('backend.master')


@section('content')
    <h1>Create Exam</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.exams.store') }}" method="POST">
        @csrf
        <label for="e_title">Title:</label>
        <input type="text" name="e_title" id="e_title">
        <label for="e_slug">Slug:</label>
        <input type="text" name="e_slug" id="e_slug">
        <button type="submit">Create</button>
    </form>
@endsection
