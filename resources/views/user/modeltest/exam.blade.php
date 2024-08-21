@extends('frontend.master')

@section('style')
<style>
    .text-success { color: green; }
    .text-danger { color: red; }
    .form-check-input:disabled { background-color: #e9ecef; cursor: not-allowed; }
    .form-check-input[disabled] + label { cursor: not-allowed; }
    #timer-container {
            font-size: 24px;
        }

        .highlight {
            background-color: yellow;
        }

        .critical {
            background-color: red;
            color: white;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            let timer;
            let timeLeft = {{$modelTest->set_time}}; // Total time in seconds

            function formatTime(seconds) {
                const hours = Math.floor(seconds / 3600);
                const minutes = Math.floor((seconds % 3600) / 60);
                const secs = seconds % 60;

                return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
            }

            function updateTimer() {
                const timerElement = document.getElementById('timer');
                timerElement.textContent = formatTime(timeLeft);

                if (timeLeft <= 0) {
                    clearInterval(timer);
                    document.getElementById('answer-form').submit();
                } else if (timeLeft <= 10) {
                    timerElement.classList.add('critical');
                } else if (timeLeft <= 20) {
                    timerElement.classList.add('highlight');
                }
                
                timeLeft--;
            }

            timer = setInterval(updateTimer, 1000);
        });
    </script>

@endsection

@section('content')
<div class="topic-header">
    <button class="back-button" onclick="javascript:history.back()">
      <span>&#x2190;</span> <!-- Left arrow for back -->
    </button>
    <h2 class="topic-title">অনুশীলন</h2>
  </div>

<main>
<div class="container">
    <h1>{{ $modelTest->title }}</h1>
    <div id="timer-container">
        Time left: <h2 id="timer"></h2>
    </div>
    <form id="answer-form" action="{{ route('author.mode-text.submit', [$course_slug, $modelTest->id]) }}" method="POST">
        @csrf

        @foreach ($modelTest->modelTestQuestions as $modelTestQuestion)
            @if($modelTestQuestion->question)
                <div class="mb-4">
                    <h4>{{ $modelTestQuestion->question->q_title }}</h4>
                    <div>
                        @foreach ($modelTestQuestion->question->options as $option)
                            <div class="form-check">
                                <input type="radio" name="answers[{{ $modelTestQuestion->question->id }}]" value="{{ $option->id }}">
                                <label>
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
        <button type="submit">Submit</button>
      
    </form>
    
    @if(session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @endif
</div>
@include('frontend.include.coursefooter')
</main>
@endsection
