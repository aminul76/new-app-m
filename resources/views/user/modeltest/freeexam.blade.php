@extends('frontend.master')

@section('style')
<style>
    .text-success { color: green; }
    .text-danger { color: red; }
    .form-check-input:disabled { background-color: #e9ecef; cursor: not-allowed; }
    .form-check-input[disabled] + label { cursor: not-allowed; }

    #timer-container {
        font-size: 24px;
        padding-right: 23px;
        display: flex;
        align-items: center;
        margin-left: auto;
    }

    .highlight {
        background-color: yellow;
    }

    .critical {
        background-color: red;
        color: white;
    }

    .topic-header {
        width: 100%;
        position: fixed;
        display: flex;
        align-items: center;
        justify-content: start;
        padding: 10px 20px;
        background-color: #fdfdfd;
        border-bottom: 1px solid #ddd;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .topic-header .topic-title {
        margin: 0;
        padding: 0;
    }

    #timer-container i {
        margin-right: 5px;
    }

    #timer {
        margin: 0;
        padding: 0;
    }

    button {
        width: calc(100% - 1em);
        padding: 0.75em;
        background: linear-gradient(135deg, #3a7bd5, #00d2ff);
        color: #fff;
        border: none;
        border-radius: 15px;
        cursor: pointer;
        font-size: 1em;
        margin-top: 30px;
    }

    button:hover {
        background-color: #2a5db0;
    }

    /* Modal Styling */
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        z-index: 9999;
        display: none;
    }

    .modal-content {
        max-width: 500px;
        margin: 10% auto;
        padding: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .modal-content input {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', () => {
    let timer;
    let timeLeft = {{ $modelTest->set_time }};
    const status = {{ $modelTest->status }};
    let modalShown = false;

    function formatTime(seconds) {
        const hours = Math.floor(seconds / 3600);
        const minutes = Math.floor((seconds % 3600) / 60);
        const secs = seconds % 60;
        return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
    }

    function showModal() {
        const modal = document.getElementById('infoModal');
        if (!modalShown) {
            modal.style.display = 'block';
            modalShown = true;
        }
    }

    function updateTimer() {
        const timerElement = document.getElementById('timer');
        timerElement.textContent = formatTime(timeLeft);

        if (timeLeft <= 0) {
            clearInterval(timer);

            if (status === 3) {
                showModal();
            } else {
                document.getElementById('answer-form').submit();
            }
        } else if (timeLeft <= 10) {
            timerElement.classList.add('critical');
        } else if (timeLeft <= 20) {
            timerElement.classList.add('highlight');
        }

        timeLeft--;
    }

    timer = setInterval(updateTimer, 1000);

    const submitButton = document.querySelector('button[type="submit"]');
    const form = document.getElementById('answer-form');
    const modal = document.getElementById('infoModal');
    const finalSubmitBtn = document.getElementById('finalSubmit');

    submitButton.addEventListener('click', function(e) {
        if (status === 3) {
            e.preventDefault();
            showModal();
        }
    });

    finalSubmitBtn.addEventListener('click', function () {
        const nameInput = document.getElementById('userName');
        const phoneInput = document.getElementById('userPhone');
        const name = nameInput.value.trim();
        const phone = phoneInput.value.trim();
        const phoneRegex = /^01[3-9][0-9]{8}$/;

        if (name === '') {
            alert('দয়া করে নাম লিখুন।');
            return;
        }

        if (!phoneRegex.test(phone)) {
            alert('সঠিক  ফোন নম্বর দিন ');
            return;
        }

        const nameField = document.createElement('input');
        nameField.type = 'hidden';
        nameField.name = 'user_name';
        nameField.value = name;

        const phoneField = document.createElement('input');
        phoneField.type = 'hidden';
        phoneField.name = 'user_phone';
        phoneField.value = phone;

        form.appendChild(nameField);
        form.appendChild(phoneField);

        modal.style.display = 'none';
        form.submit();
    });
});
</script>

@endsection

@section('content')
<div class="topic-header">
    <p class="topic-title">মডেল টেস্ট</p>
    <div id="timer-container">
        <i class="far fa-clock"></i> <p id="timer"></p>&nbsp;&nbsp;
    </div>
</div>

<main>
<div class="container">
    <h1>{{ $modelTest->title }}</h1>

    <form id="answer-form" action="{{ route('author.mode-text.freeexam', [$course_slug, $modelTest->id]) }}" method="POST">
        @csrf

        @foreach ($modelTest->modelTestQuestions as $index => $modelTestQuestion)
            @if($modelTestQuestion->question)
                <div class="mb-4">
                    <h4> {{ \App\Helpers\DateHelper::toBengaliNumerals($index + 1) }} )  {!! $modelTestQuestion->question->q_title !!}</h4>
                    <div>
                        @foreach ($modelTestQuestion->question->options as $option)
                            <div class="form-check">
                                <input type="radio" name="answers[{{ $modelTestQuestion->question->id }}]" value="{{ $option->id }}">
                                <label>{!! $option->p_title !!}</label>
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

<!-- Include footer -->
@include('frontend.include.coursefooter')
</main>

<!-- Modal Popup -->
<div id="infoModal" class="modal">
    <div class="modal-content">
        <!-- <h3>আপনার তথ্য দিন</h3> -->
        <div class="form-group">
            <label for="userName">Name:</label>
            <input type="text" id="userName" name="modal_user_name"  required>
        </div>
        <div class="form-group">
            <label for="userPhone">Mobile Number:</label>
            <input type="text" id="userPhone" name="modal_user_phone"  required pattern="^(?:\+88|88)?01[3-9][0-9]{8}$"  minlength="11"
       maxlength="11">
        </div>
        <button id="finalSubmit" class="btn btn-success">Final Submit</button>
    </div>
</div>
@endsection
