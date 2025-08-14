@extends('backend.master')

@section('content')
<h1>Bulk Update Start Date for All Videos</h1>

<!-- Form to input the number of days to add -->
<form action="{{ route('admin.videos.update_all') }}" method="POST">
    @csrf

    <label for="start_date">Start Date:</label>
    <input type="datetime-local" name="start_date" id="start_date" 
           value="{{ $video->start_date->format('Y-m-d\TH:i') }}" required><br>

           <label for="end_date">Start Date:</label>
           <input type="datetime-local" name="end_date" id="end_date" 
                  value="{{ $video->end_date->format('Y-m-d\TH:i') }}" required><br>
    <button type="submit">Update All Start Dates</button>
</form>
@endsection
