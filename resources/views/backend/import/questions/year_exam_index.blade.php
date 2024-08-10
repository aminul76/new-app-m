@extends('backend.master')

@section('content')
    <h1>Import/Export Questions</h1>
    <p>প্রথাম কলামে কোন হেডিং থাকবে না প্রশ্ন থাকবে১,৬,১১ অপশন থাকবে২,৩,৪,৫ দ্বিতীয় কলামে উপত্তর থাবে যে অপশনে উত্তর হবে তা
        ১ দিতে হবে উদাহরন <a target="_blank" href="https://docs.google.com/spreadsheets/d/1sIlH6yOAG16D5aIAhaOhSsYKASF0DI2k97bC8l9LNic/edit?usp=sharing">example</a>
    <p>
        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif

        <!-- Import Form -->
    <form action="{{ route('admin.yearexam') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="subject_id">Subject:</label>
        <select name="subject_id" id="subject_id" required>
            <option value="">Select a Subject</option>
            @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->s_title }}</option>
            @endforeach
        </select>

        <label for="year_id">year:</label>
        <select name="year_id" id="year_id" required>
            <option value="">Select a year</option>
            @foreach ($years as $year)
                <option value="{{ $year->id }}">{{ $year->y_title }}</option>
            @endforeach
        </select>



        <label for="exam_id">exam:</label>
        <select name="exam_id" id="exam_id" required>
            <option value="">Select a exam</option>
            @foreach ($exams as $exam)
                <option value="{{ $exam->id }}">{{ $exam->e_title }}</option>
            @endforeach
        </select>


        <label class="file-input-label" for="file-input">Choose a file</label>
        <input type="file" id="file-input" name="file" accept=".xlsx,.csv">
        <br>
        <button type="submit">Import</button>
    </form>

    <!-- Export Button -->

@endsection
