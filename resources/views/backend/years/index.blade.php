@extends('backend.master')
@section('content')
    <h1>Years List</h1>
    <a href="{{ route('admin.years.create') }}">Create New Year</a>
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
            @foreach ($years as $year)
                <tr>
                    <td>{{ $year->id }}</td>
                    <td>{{ $year->y_title }}</td>
                    <td>{{ $year->y_slug }}</td>
                    <td>
                        <a  href="{{ route('admin.years.edit', $year->id) }}">Edit</a>
                        <form action="{{ route('admin.years.destroy', $year->id) }}" method="POST" style="display:inline;">
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
