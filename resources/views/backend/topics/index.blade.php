@extends('backend.master')

@section('content')
    <h1>Subject Item Topics List</h1>
    <a href="{{ route('admin.topics.create') }}">Create New Topic</a>
    @if ($message = Session::get('success'))
        <p>{{ $message }}</p>
    @endif
    <table id="dTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Subject</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topics as $topic)
                <tr>
                    <td>{{ $topic->id }}</td>
                    <td>{{ $topic->t_title }}</td>
                    <td>{{ $topic->t_slug }}</td>
                    <td>{{ $topic->subject->s_title }}</td>
                    <td>
                        <a href="{{ route('admin.topics.edit', $topic->id) }}">Edit</a>
                        <form action="{{ route('admin.topics.destroy', $topic->id) }}" method="POST" style="display:inline;">
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
