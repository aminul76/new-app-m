@extends('backend.master')

@section('content')



<h1>Questions List </h1>

@foreach($groupedQuestions as $question)
    <div class="question">
        <h2>{{ $question['title'] }}</h2>
        <p>{{ $question['explain'] }}</p>

        <ul class="options">
            @foreach($question['options'] as $option)
                <li>
                    <label>
                        <input type="radio" name="question_{{ $question['id'] }}" value="{{ $option['id'] }}">
                        {{ $option['title'] }}
                        @if($option['is_correct'])
                            <span>(Correct Answer)</span>
                        @endif
                    </label>
                </li>
            @endforeach
        </ul>
    </div>
@endforeach





        @endsection
