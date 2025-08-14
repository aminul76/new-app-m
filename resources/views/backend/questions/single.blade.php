
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Question Design</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    body {
  margin: 0;
  font-family: Arial, sans-serif;
  background-color: #ffda44;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.question-container {
  text-align: center;
  background: linear-gradient(135deg, #3a7bd5, #00d2ff);
  padding: 20px;
  border-radius: 10px;
  width: 90%;
  max-width: 500px;
}

.question-mark {
  font-size: 80px;
  font-weight: bold;
  color: #ffffff;
  text-shadow: 0px 3px 6px rgba(0, 0, 0, 0.3);
}

.question-text {
  margin: 20px 0;
  font-size: 32px;
  font-weight: bold;
  color: #ffffff;
  text-shadow: 0px 3px 6px rgba(0, 0, 0, 0.3);
}

.options {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.option {
  padding: 15px;
  border-radius: 31px 0px;
  background-color: #022d5c;
  color: white;
  font-size: 24px;
  font-weight: bold;
  text-align: left;
  padding-left: 20px;
  position: relative;
  text-shadow: 0px 3px 6px rgba(0, 0, 0, 0.3);
}

.option::before {
  content: attr(data-letter);
  position: absolute;
  left: 10px;
  top: 50%;
  transform: translateY(-50%);
  font-weight: bold;
}

.option:hover {
  background-color: #007bff;
  cursor: pointer;
}

  </style>
</head>
<body>


  {{-- <div class="question-container">
    <div class="question-mark">?</div>
    <div class="question-text">Your question goes here:</div>
    <div class="options">
      <div class="option">A. Text Space Here</div>
      <div class="option">B. Your Text Box</div>
      <div class="option">C. Option C Here</div>
      <div class="option">D. Random Space</div>
    </div>
    <h2 style="color: #ffffff;">bdlivemcq.com</h2>
  </div> --}}



  <div class="question-container" id="question-{{ $question->id }}">
    <div class="question-mark">?</div>

    <div class="question-text">{{ $question->q_title }}</div>
        @foreach ($question->exams as $exam)
       <p><i style="color: #022d5c;size:15px"> - {{ $exam->e_title }}
        @endforeach
        @foreach ($question->years as $year)
   
         -{{ $year->y_title }} </i></p>
        @endforeach
    
   
    
    
    
    <div class="options">
        @foreach ($question->options as $option)
           
            
                
        <div class="option"> {!! $option->p_title !!}</div>
         
        @endforeach
        <h2 style="color: #ffffff;">bdlivemcq.com</h2>
    </div>
   
      
    <!-- Display exam and year information -->
 
   
</div>




</body>
</html>
