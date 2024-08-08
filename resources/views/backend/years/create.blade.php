@extends('backend.master')


@section('content')
    <h1>Create Year</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.years.store') }}" method="POST">
        @csrf
        <label for="y_title">Title:</label>
        <input type="text" name="y_title" id="y_title">
        <label for="y_slug">Slug:</label>
        <input type="text" name="y_slug" id="y_slug">
        <button type="submit">Create</button>
    </form>
@endsection
