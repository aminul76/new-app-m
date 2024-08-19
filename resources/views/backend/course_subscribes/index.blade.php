@extends('backend.master')
@section('content')
<a href="{{ route('admin.course-subscribes.create') }}">Create New Course</a>
    @if ($message = Session::get('success'))
        <p>{{ $message }}</p>
    @endif
<!-- Display all subscriptions -->
<table id="dTable" class="display">
        <thead>
        <tr>
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">User</th>
            <th class="border px-4 py-2">Course</th>
            <th class="border px-4 py-2">Subscribed At</th>
            <th class="border px-4 py-2">Expires At</th>
            <th class="border px-4 py-2">Status</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subscriptions as $subscription)
            <tr>
                <td class="border px-4 py-2">{{ $subscription->id }}</td>
                <td class="border px-4 py-2">{{ $subscription->user->name }}</td> <!-- Accessing user details -->
                <td class="border px-4 py-2">{{ $subscription->course->c_title }}</td>
                <td class="border px-4 py-2">{{ $subscription->subscribed_at ? $subscription->subscribed_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                <td class="border px-4 py-2">{{ $subscription->expires_at ? $subscription->expires_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                <td class="border px-4 py-2">{{ $subscription->status == 1 ? 'Active' : 'Deactivated' }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('admin.course-subscribes.edit', $subscription->id) }}" class="text-blue-500">Edit</a>
                    <form action="{{ route('admin.course-subscribes.destroy', $subscription->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500" onclick="return confirm('Are you sure you want to delete this subscription?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection