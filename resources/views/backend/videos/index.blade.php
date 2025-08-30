@extends('backend.master')


@section('content')
<h1>All Videos</h1>
<a href="{{ route('admin.videos.create') }}">Create New Video</a>

<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Course</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($videos as $video)
            <tr>
                <td>{{ $video->title }}</td>
                <td>{{ $video->course->name }}</td>
                <td>{{ $video->status }}</td>

                <td>
                    <a href="{{ url('admin/videosday/editall', $video->id) }}">day</a>


                    {{-- <a href="{{ route('admin.videos.edit-all', $video->id) }}">day</a> --}}
                    <a href="{{ route('admin.videos.edit', $video->id) }}">Edit</a>
                    <form action="{{ route('admin.videos.destroy', $video->id) }}" method="POST" onsubmit="return confirmDelete();">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>

                    <script>
                    function confirmDelete() {
                        return confirm('Are you sure you want to delete this video?');
                    }
                    </script>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
