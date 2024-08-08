@extends('backend.master')


@section('content')
    <h1>Subjects List</h1>
    <a href="{{ route('admin.subjects.create') }}">Create New Subject</a>
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
            @foreach ($subjects as $subject)
                <tr>
                    <td>{{ $subject->id }}</td>
                    <td>{{ $subject->s_title }}</td>
                    <td>{{ $subject->s_slug }}</td>
                    <td>
                        <a href="{{ route('admin.subjects.edit', $subject->id) }}">Edit</a>
                        <form action="{{ route('admin.subjects.destroy', $subject->id) }}" method="POST" style="display:inline;">
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
