@extends('backend.master')

@section('content')
    <h1>labels List</h1>

    @if ($message = Session::get('success'))
        <p>{{ $message }}</p>
    @endif
    <table id="dTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>topic Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($labels as $label)
                <tr>
                    <td>{{ $label->id }}</td>
                    <td>{{ $label->i_title }}</td>
                    <td>{{ optional($label->questions->first())->topic_id }}</td>
                    <td>
                        <a href="{{ route('admin.label.subject', $label->id) }}">TopicAdds</a>
                         <a href="{{ route('admin.label.subject.single', $label->id) }}">SameTopicAdds</a>
                        <form action="{{ route('admin.import-label.destroy', $label->id) }}" method="POST" style="display:inline;">
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
