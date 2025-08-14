@extends('frontend.master')

 @section('seo')
   <!-- General Meta Tags -->
   <meta name="description" content="{{ $question->q_explain }}">
   @php
    $keywords = $question->options->pluck('p_title')->implode(', ');
@endphp

<meta name="keywords" content="{{ $keywords }}">
   
   <!-- Open Graph Meta Tags for Social Media -->
   <meta property="og:title" content="{{ $question->q_title}}">
   <meta property="og:description" content="{{ $question->q_explain }}">
   <meta property="og:url" content="{{ url()->current() }}">
   <meta property="og:type" content="question">
   <meta property="og:site_name" content="{{ config('app.name') }}">
   
   <!-- Twitter Card Meta Tags -->
   <meta name="twitter:card" content="summary_large_image">
   <meta name="twitter:title" content="{{ $question->q_title}}">
   <meta name="twitter:description" content="{{ $question->q_explain }}">
   
   <!-- Favicon (Optional) -->
   
   <!-- Title -->
   <title>{{ $question->q_title}}</title>  
@endsection 

@section('style')
    <style>
        .option {
            padding: 10px;
            margin: 5px 0;
            cursor: pointer;
            border: 1px solid #ccc;
        }
        .option.correct {
            background-color: #d4edda; /* Light green for correct answer */
        }
        .option.incorrect {
            background-color: #f8d7da; /* Light red for incorrect answer */
        }
        .explanation {
            display: none;
            margin-top: 5px;
            font-style: italic;
        }
        .explanation.show {
            display: block;
        }
        /* Container for pagination */
      /* Pagination Container */
nav[role="navigation"] {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

/* Hidden on small screens, visible on medium and larger screens */
@media (min-width: 640px) {
  .sm\\:hidden {
    display: none;
  }
}

.sm\\:flex-1 {
  flex: 1;
}

.sm\\:flex {
  display: flex;
}

.sm\\:items-center {
  align-items: center;
}

.sm\\:justify-between {
  justify-content: space-between;
}

/* Pagination Button Styles */
.relative {
  position: relative;
}

.inline-flex {
  display: inline-flex;
}

.items-center {
  align-items: center;
}

.px-4 {
  padding-left: 1rem;
  padding-right: 1rem;
}

.py-2 {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
}

.text-sm {
  font-size: 0.875rem;
}

.font-medium {
  font-weight: 500;
}

.text-gray-500 {
  color: #6b7280;
}

.bg-white {
  background-color: #ffffff;
}

.border {
  border-style: solid;
}

.border-gray-300 {
  border-color: #d1d5db;
}

.cursor-default {
  cursor: default;
}

.leading-5 {
  line-height: 1.25rem;
}

.rounded-md {
  border-radius: 0.375rem;
}

.hover\\:text-gray-500:hover {
  color: #6b7280;
}

.focus\\:outline-none:focus {
  outline: none;
}

.focus\\:ring {
  box-shadow: 0 0 0 3px rgba(209, 213, 219, 0.5);
}

.ring-gray-300 {
  box-shadow: 0 0 0 0px rgb(255, 255, 255);
}

.focus\\:border-blue-300:focus {
  border-color: #93c5fd;
}

.active\\:bg-gray-100:active {
  background-color: #f3f4f6;
}

.active\\:text-gray-700:active {
  color: #374151;
}

.transition {
  transition: all 0.15s ease-in-out;
}

.ease-in-out {
  transition-timing-function: ease-in-out;
}

.duration-150 {
  transition-duration: 150ms;
}

.dark\\:text-gray-600 {
  color: #d1d5db;
}

.dark\\:bg-gray-800 {
  background-color: #1f2937;
}

.dark\\:border-gray-600 {
  border-color: #4b5563;
}

.dark\\:text-gray-300 {
  color: #d1d5db;
}

.dark\\:focus\\:border-blue-700:focus {
  border-color: #3b82f6;
}

.dark\\:active\\:bg-gray-700:active {
  background-color: #374151;
}

.dark\\:active\\:text-gray-300:active {
  color: #d1d5db;
}

/* SVG Icon Styles */
.w-5 {
  width: 1.25rem;
}

.h-5 {
  height: 1.25rem;
}

/* Current Page Indicator */
[aria-current="page"] .text-gray-500 {
  color: #6b7280;
  background-color: #ffffff;
}

[aria-disabled="true"] {
  cursor: default;
}

.rounded-l-md {
  border-top-left-radius: 0.375rem;
  border-bottom-left-radius: 0.375rem;
}

.rounded-r-md {
  border-top-right-radius: 0.375rem;
  border-bottom-right-radius: 0.375rem;
}
.hidden {
    display: none;
}

/* Styles that should apply for screens larger than 640px (sm breakpoint) */
@media (min-width: 640px) {
    .sm\\:flex-1 {
        flex: 1;
    }

    .sm\\:flex {
        display: flex;
    }

    .sm\\:items-center {
        align-items: center;
    }

    .sm\\:justify-between {
        justify-content: space-between;
    }

    /* You might want to override the hidden class on larger screens if needed */
    .sm\\:hidden {
        display: none;
    }
}
    </style>
@endsection

@section('content')
<div class="topic-header">
    <button class="back-button" onclick="javascript:history.back()">
      <span>&#x2190;</span> <!-- Left arrow for back -->
    </button>
    <h2 class="topic-title">প্রশ্ন</h2>
</div>

<main>
   
        <div class="question" id="question-{{ $question->id }}">
            <h4>{{ $question->q_title }}
            
            @foreach ($question->exams as $exam)
               <i style="color:#3a7bd5"> - {{ $exam->e_title }}
            @endforeach
            @foreach ($question->years as $year)
           
                 -{{ $year->y_title }} </i>
            @endforeach
            </h4>
            <div class="options">
                @foreach ($question->options as $option)
                    <div 
                        class="option"
                        data-is-correct="{{ $option->is_correct }}"
                        onclick="handleOptionClick(this, {{ $question->id }}, {{ $option->is_correct }})">
                        {!! $option->p_title !!}
                    </div>
                @endforeach
            </div>
            @if ($question->q_explain!=null)
            <span class="explanation">ব্যাখা:{{ $question->q_explain }}</span>
            @endif
              
            <!-- Display exam and year information -->
         
           
        </div>
  
  
            
           
  


             

    
</main>

@section('js')
<script>
    function handleOptionClick(element, questionId, isCorrect) {
        // Select all options within the specific question
        const questionElement = document.getElementById('question-' + questionId);
        const options = questionElement.querySelectorAll('.option');
        
        // Clear previous selections
        options.forEach(opt => {
            opt.classList.remove('correct', 'incorrect');
        });

        // Set current option style
        if (isCorrect) {
            element.classList.add('correct');
        } else {
            element.classList.add('incorrect');
        }

        // Highlight the correct option within the question
        const correctOptions = questionElement.querySelectorAll('.option[data-is-correct="1"]');
        correctOptions.forEach(opt => {
            opt.classList.add('correct');
        });

        // Show explanation
        const explanation = questionElement.querySelector('.explanation');
        explanation.classList.add('show');
    }
</script>
@endsection
@endsection
