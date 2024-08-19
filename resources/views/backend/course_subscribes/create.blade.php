@extends('backend.master')
@section('content')
    <div class="container mx-auto mt-4">
        <h1 class="text-2xl font-bold mb-4">Create New Subscription</h1>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <strong class="font-bold">Whoops!</strong>
                <span class="block sm:inline">There were some problems with your input.</span>
                <ul class="list-disc pl-5 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Subscription Creation Form -->
        <form action="{{ route('admin.course-subscribes.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="user_id" class="block text-sm font-medium mb-1">User</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    <option value="" disabled selected>Select a user</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="course_id" class="block text-sm font-medium mb-1">Course</label>
                <select name="course_id" id="course_id" class="form-select" required>
                    <option value="" disabled selected>Select a course</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->c_title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="subscribed_at" class="block text-sm font-medium mb-1">Subscribed At</label>
                <input type="datetime-local" name="subscribed_at" id="subscribed_at" class="form-input" value="{{ old('subscribed_at') }}">
            </div>
            <div class="mb-4">
                <label for="expires_at" class="block text-sm font-medium mb-1">Expires At</label>
                <input type="datetime-local" name="expires_at" id="expires_at" class="form-input" value="{{ old('expires_at') }}">
            </div>
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium mb-1">Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                    <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Deactivated</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create</button>
        </form>
    </div>
@endsection
