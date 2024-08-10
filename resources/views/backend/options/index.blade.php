@extends('backend.master')

@section('content')
    <h1>Options List</h1>
    <a href="{{ route('admin.options.create') }}">Create New Option</a>
    @if ($message = Session::get('success'))
        <p>{{ $message }}</p>
    @endif
    <table id="dTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Title</th>
                <th>Is Correct</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($options as $option)
                <tr>
                    <td>{{ $option->id }}</td>
                    <td>{{ $option->question->q_title }}</td>
                    <td>{{ $option->p_title }}</td>
                    <td>{{ $option->is_correct == 1 ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('admin.options.edit', $option->id) }}">Edit</a>
                        <form action="{{ route('admin.options.destroy', $option->id) }}" method="POST" style="display:inline;">
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
