@extends('backend.master')

@section('content')
    <h1>Posts List</h1>
    <a href="{{ route('admin.posts.create') }}">Create New Post</a>

    @if ($message = Session::get('success'))
        <p style="color: green;">{{ $message }}</p>
    @endif

    <table id="dTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Short Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ Str::limit($post->short_description, 50) }}</td>
                    <td>
                       @if($post->photo)
                            <img src="{{ asset($post->photo) }}" width="80">
                        @elseif($post->photolink)
                            <img src="{{ $post->photolink }}" width="80">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>

                        <script>
                            function confirmDelete() {
                                return confirm('Are you sure you want to delete this post?');
                            }
                        </script>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
