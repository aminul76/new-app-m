@extends('backend.master')


@section('content')
    <h1>Exams List</h1>
    <a href="{{ route('admin.exams.create') }}">Create New Exam</a>
    @if ($message = Session::get('success'))
        <p>{{ $message }}</p>
    @endif
    <table id="dTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($exams as $exam)
                <tr>
                    <td>{{ $exam->id }}</td>
                    <td>{{ $exam->e_title }}</td>
                    <td>{{ $exam->e_slug }}</td>
                    <td>
                        <a href="{{ route('admin.exams.edit', $exam->id) }}">Edit</a>
                        <form action="{{ route('admin.exams.destroy', $exam->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
