<!-- resources/views/user/modeltest/results.blade.php -->
@extends('frontend.master')

@section('style')
<style>
    .text-success { color: green; }
    .text-danger { color: red; }
    .option-correct { color: green; }
    .option-wrong { color: red; }
   /* Hide native radio button */
  /* Basic styling for radio buttons */
  input[type="radio"] {
    position: relative;
    width: 15px;
    height: 15px;
    appearance: none;
    border: 2px solid #666;
    border-radius: 50%;
    outline: none;
    cursor: pointer;
    background-color: #fff;
    transition: background-color 0.3s, border-color 0.3s;
  }
  
  /* Styling when the radio button is checked */
  input[type="radio"]:checked {
    background-color: #007bff;
    border-color: #007bff;
  }
  
  /* Styling when the radio button is disabled */
  input[type="radio"]:disabled {
    cursor: not-allowed;
    background-color: #e9ecef;
    border-color: #ced4da;
  }

  /* Styling when the radio button is checked and disabled */
  input[type="radio"]:checked:disabled {
    background-color: #6c757d;
    border-color: #6c757d;
  }

</style>
@endsection

@section('content')
<div class="topic-header">
    <button class="back-button" onclick="javascript:history.back()">
      <span>&#x2190;</span> <!-- Left arrow for back -->
    </button>
    <h2 class="topic-title">Exam Results</h2>
</div>

<main>
<div class="container">
    <h1>{{ $modelTest->title }}</h1>

    <h3>All Questions and Answers:</h3>
    @foreach ($modelTest->modelTestQuestions as $modelTestQuestion)
        @if($modelTestQuestion->question)
            <div class="mb-4">
                <h4>{{ $modelTestQuestion->question->q_title }}</h4>
                <div>
                    @foreach ($modelTestQuestion->question->options as $option)
                        @php
                            $isUserAnswer = isset($userAnswers[$modelTestQuestion->question->id]) && $userAnswers[$modelTestQuestion->question->id] == $option->id;
                            $isCorrectAnswer = $option->is_correct;
                        @endphp
                        <div class="form-check">
                            <input type="radio" disabled {{ $isUserAnswer ? 'checked' : '' }}>
                            <label class="{{ $isUserAnswer ? ($isCorrectAnswer ? 'option-correct' : 'option-wrong') : ($isCorrectAnswer ? 'text-success' : '') }}">
                                {{ $option->p_title }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="mb-4">
                <p>Question not found.</p>
            </div>
        @endif
    @endforeach
    
    {{-- <a href="{{ route('author.mode-text.exam', [$course_slug, $modelTest->id]) }}" class="btn btn-primary">Retry Exam</a> --}}
</div>
@include('frontend.include.coursefooter')
</main>
@endsection
