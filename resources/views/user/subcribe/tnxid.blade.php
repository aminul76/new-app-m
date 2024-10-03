@extends('frontend.master')

@section('style')
<style>
    
    @font-face {
  font-family: bangla;
  src: url(banglabold.ttf);
}
@font-face {
  font-family: english;
  src: url(Aileron-Bold.otf);
}
* {
  margin: 0;
  padding: 0;
  font-size: 14px;
  font-family: Cambria, Cochin, Georgia, Times, "Times New Roman", serif;
}
*:lang(en) {
  font-family: "english", sans-serif; /* Font for English text */
}

*:lang(bn) {
  font-family: "bangla", sans-serif; /* Font for Bengali text */
}
a {
  text-decoration: none;
  font-family: english;
  font-size: 14px;
  color: #1976d3;
  transition: 0.3s all;
}
a:hover {
  color: #09a9f3;
}
h1,
h2,
h3,
h4,
h5,
h6 {
  font-family: "english", sans-serif;
}
.p-1 {
  padding: 1rem;
}

.p-2 {
  padding: 2rem;
}

.p-3 {
  padding: 3rem;
}
.m-1 {
  margin: 5px;
}
body {
  background: #ffffff;
  height: 100vh;
  width: 100vw;
  overflow-x: hidden;
  overflow-y: auto;
  line-height: 30px;
}
::-webkit-scrollbar {
  display: none; /* for Chrome, Safari, and Opera */
}
.container-m {
  border-radius: 10px;
  margin: auto;
  width: 400px;
  background-color: #03a9f5;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  box-shadow: 0px 0px 34px -12px #615f5f;
}
.card {
  background: #ffffff;
  border-radius: 10px;
  padding: 15px;
}
.d-flex {
  display: flex;
}
.d-flex-s {
  display: flex;
  justify-content: space-between;
}
.top {
  margin: 10px 15px;
  color: #ffffff;
}
.logo img {
  max-width: 140px;
  height: auto;
  filter: brightness(100);
}
.top button {
  border: none;
  cursor: pointer;
  background: none;
  color: #ffffff;
  font-size: 20px;
}
.brand {
  margin: 15px;
}
.brand-logo {
  
 
}
.brand-logo img {
  object-fit: contain;
  max-width: 100%;
  max-height: 100%;
}
.brand-info {
  margin-left: 20px;
  margin-top: 10px;
  text-align: center;
}
.brand-info h1 {
  text-align: center;
  font-size: 26px;
  font-family: bangla;
}

.brand-info .d-flex div {
  background: #e4f2fd;
  border-radius: 20px;
  padding: 0px 20px 0px 20px;
  margin: 5px;
  font-size: 14px;
  color: #3f98d8;
  font-weight: bold;
  cursor: pointer;
  font-family: bangla;
}

.method {
  background: #d5d5d5;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
  margin-top: 20px;
  padding: 15px;
  height: 300px;
}
.method .menu {
  justify-content: center;
  align-items: center;
  background: #03a9f5;
  border-radius: 15px;
  height: 30px;
  color: #ffffff;
  display: flex;
  align-items: center;
  line-height: 23px;
}
.method h1 {
  text-align: center;
  margin-bottom: 20px;
  font-size: 20px;
}
.menu-btn {
  font-family: bangla;
  cursor: pointer;
  font-size: 12px;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.mbtn.active {
  background: #1976d3 !important;
  color: #ffffff !important;
  border-radius: 15px;
}
.tab-content {
  display: none;
}
.tab-content.active {
  display: block;
}
.tab-content .methods {
  padding: 2px;
  margin: 20px;
  max-height: 200px;
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 10px;
  overflow-y: auto;
  overflow-x: hidden;
}
.method .methods::-webkit-scrollbar {
  width: 0;
  background: transparent;
}
.row {
  position: relative;
  width: 100%;
  max-width: 168px;
  height: 50px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  border: 1px solid #aaafb2;
  background: #ffffff;
}
.row img {
  max-width: 80px;
  width: 100%;
  max-height: 100%;
  transition: transform 0.2s;
}
.row img:hover {
  transform: scale(1.1);
  max-height: 90%;
  max-width: 90%;
  border-radius: 8px;
}
.bottom {
  margin: -1px;
  margin-top: -10px;
  height: 55px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #d4e4fd;
  color: #0a4ab7;
  border-radius: 15px 15px 0px 0px;
  font-size: 17px;
  font-weight: 700;
  cursor: pointer;
  font-family: "english", sans-serif;
}
#brand-support .row:nth-child(1) {
  font-size: 1.5rem;
  color: #19c37d;
}
#brand-support .row:nth-child(2) {
  font-size: 1.5rem;
  color: #19c37d;
  font-weight: 700;
  background-color: #ca4246;
  background-image: linear-gradient(
    45deg,
    #ca4246 16.666%,
    #e16541 16.666%,
    #e16541 33.333%,
    #f18f43 33.333%,
    #f18f43 50%,
    #8b9862 50%,
    #8b9862 66.666%,
    #476098 66.666%,
    #476098 83.333%,
    #a7489b 83.333%
  );
  background-size: 100%;
  background-repeat: repeat;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.tab-content p {
  text-align: center;
  padding: 5px;
  font-size: 16px;
  color: #1976d3;
  background: #d4e4fd;
  font-family: english;
}
.tab-content table {
  color: #615f5f;
  border-collapse: collapse;
  width: 100%;
}
table tr {
  border-bottom: 1px solid rgba(105, 104, 104, 0.315);
}
th {
  font-family: english;
  text-align: left;
  padding: 8px;
}
td {
  font-family: english;
  text-align: right;
  padding: 8px;
}
/* toast css  */
.toast {
  position: fixed;
  top: 20px;
  right: 20px;
  background: #fcfcfc;
  padding: 20px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  border-left: 6px solid #f46940;
  overflow: hidden;
  transform: translateX(calc(100% + 30px));
  transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35);
  z-index: 999;
}
.toast-content .check {
  height: 30px;
  width: 30px;
  border-radius: 50%;
  background: #8c8cb585;
  padding: 5px;
}
.toast.active {
  transform: translateX(0%);
}

.toast-content {
  display: flex;
  align-items: center;
}

.toast-content .check {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 35px;
  width: 35px;
  font-size: 16px;
  border-radius: 50%;
  color: #fff;
}

.success .check {
  background: #41b883;
}

.error .check {
  background: red;
}


.toast.check.error {
  background-color: #e74c3c;
}

.toast-content .message {
  display: flex;
  flex-direction: column;
  margin: 0 20px;
}

.success .message .text{
  font-size: 16px;
  font-weight: 400;
  color: green;
}
.error .message .text{
  font-size: 16px;
  font-weight: 400;
  color: red;
}
.message .text.text-1 {
  font-weight: 600;
  font-size: 24px;
  color: #74848B;
}

.toast .close {
  position: absolute;
  top: 10px;
  right: 15px;
  padding: 5px;
  cursor: pointer;
  opacity: 0.7;
}

.toast .close:hover {
  opacity: 1;
}

.toast .progress {
  position: absolute;
  bottom: 0;
  left: 0;
  height: 5px;
  width: 100%;
  background: #ddd;
}

.toast .progress:before {
  content: "";
  position: absolute;
  bottom: 0;
  right: 0;
  height: 100%;
  width: 100%;
  background-color: #96cfc9;
}

.progress:before {
  animation: progress 3s linear forwards;
}

@keyframes progress {
  100% {
    right: 100%;
  }
}
/* toast css  */

@media screen and (max-width: 600px) {
  .container-m {
    width: 100vw;
    top: 0px;
    left: 0;
    transform: none;
    border-radius: 0;
  }
  .method {
    height: 100vh;
  }
  .brand-info h1 {
    font-size: 20px;
  }
  .brand-info .d-flex div {
    font-size: 12px;
    padding: 0px 10px 0px 10px;
  }
  .method h1 {
    font-size: 16px;
  }
  .menu-btn {
    font-size: 10px;
  }
  .bottom {
    position: fixed;
    bottom: 0;
    width: 100%;
  }
  .tab-content .methods {
    margin: 20px;
    max-height: calc(100vh - 360px);
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }
  .row {
    max-width: 168px;
    height: 60px;
  }
}
.bank-pay{border-radius:10px;}
.bank-pay label{font-size:12px;}
.row .ribbon {
    --f: 5px;
    --r: 10px;
    --t: -5px;
    font-size: 13px;
    font-weight: bold;
    position: absolute;
    inset: var(--t) calc(-1*var(--f)) auto auto;
    padding: 0 5px var(--f) calc(5px + var(--r));
    clip-path: polygon(0 0, 100% 0, 100% calc(100% - var(--f)), calc(100% - var(--f)) 100%, calc(100% - var(--f)) calc(100% - var(--f)), 0 calc(100% - var(--f)), var(--r) calc(50% - var(--f)/2));
    background: #079be345;
    box-shadow: 0 calc(-1*var(--f)) 0 inset #0005;
}

    .brand .d-flex {
    justify-content: unset;
  }
  .brand-info {
    margin-left: 20px;
    margin-top: 10px;
  }
  p {
    font-family: Impact, Haettenschweiler, "Arial Narrow Bold", sans-serif;
    color: rgb(141, 131, 117);
    font-weight: 700;
  }
  .method {
    text-align: center;
  }
  .method img {
    height: auto;
    width: 40%;
  }
  .method input {
    height: 35px;
    border: none;
    width: 90%;
    padding: 7px;
    text-align: center;
    border-radius: 5px;
    font-size: 16px;
    font-family: bangla;
  }
  
  .method input::after {
    content: '|';
    position: absolute;
    top: 50%;
    right: 5px; 
    transform: translateY(-50%);
    animation: blink-cursor 1s step-end infinite;
  }
  @keyframes blink-cursor {
    from, to {
      opacity: 0;
    }
    50% {
      opacity: 1;
    }
  }
  .method-text {
    margin-top: 10px;
    word-wrap: break-word;
    text-align: left;
    line-height: 18px;
    width: 90%;
    margin: auto;
    background: #ffffff;
    padding: 5px;
    margin-bottom: 30px;
    font-size: 12px;
  }
  .method-text p {
    margin-bottom: 15px;
    padding-bottom: 3px;
    border-bottom: 1px solid #ece8e8;
  }
  .copy-btn {
    margin-top: -7px;
    cursor: pointer;
    padding: 5px 10px;
    border-radius: 10px;
  }
  .method {
    height: unset;
  }
  @media screen and (max-width: 600px) {
        .method {
      height: 100vh;
    }
  }
  
  @keyframes ldio-japzwhp0h9j {
    0% {
      top: 96px;
      left: 96px;
      width: 0;
      height: 0;
      opacity: 1;
    }
    100% {
      top: 18px;
      left: 18px;
      width: 156px;
      height: 156px;
      opacity: 0;
    }
  }
  .ldio-japzwhp0h9j div {
    position: absolute;
    border-width: 4px;
    border-style: solid;
    opacity: 1;
    border-radius: 50%;
    animation: ldio-japzwhp0h9j 1s cubic-bezier(0,0.2,0.8,1) infinite;
  }
  .ldio-japzwhp0h9j div:nth-child(1) {
    border-color: #e90c59;
    animation-delay: 0s;
  }
  .ldio-japzwhp0h9j div:nth-child(2) {
    border-color: #46dff0;
    animation-delay: -0.5s;
  }
  #loader {
      background-color: rgb(175 168 168 / 60%);
      z-index: 99999999999;
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
      display:none;
  }
  .loadingio-spinner-ripple-wsf5cxo48ch {
      width: 200px;
      height: 200px;
      overflow: hidden;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
  }
  .ldio-japzwhp0h9j {
    width: 100%;
    height: 100%;
    position: relative;
    transform: translateZ(0) scale(1);
    backface-visibility: hidden;
    transform-origin: 0 0; /* see note above */
  }
  .ldio-japzwhp0h9j div { box-sizing: content-box; }

  input[type="text"] {
    border: 1px solid #ccc;
    background-color: #ffffff;
    padding: 8px;
    font-size: 16px;
}
  input::placeholder {
    color: #888; /* Change this to your desired color */
    opacity: 1;  /* Set opacity to ensure color is visible */
}
.error {
            color: red;
        }
</style>
@endsection





@section('content')



<div id="loader"><div class="loadingio-spinner-ripple-wsf5cxo48ch"><div class="ldio-japzwhp0h9j"> <div> </div><div></div> </div></div></div>
<div class="container-m bg1">
  <div class="top d-flex-s">
    <div class="logo">
    </div>
    <button onclick="javascript:history.back()">&#x2716;</button>
  </div>
  <div class="brand">
    <div class="card d-flex">
      <div class="brand-logo">
      </div>
      <div class="brand-info">
        <h1>BD LIVE MCQ</h1>
        <div class="method-text">
           
         
            <p>
            নিচে থাকা নাম্বারে সেন্ড মানি করে ফর্মটি পূরন করুন।
            <br />
            <br />
            <span class="d-flex-s">
                <span class="bg2-t">01727908089</span>
                <span class="copy-btn bg2 text-to-clipboard" data-value="01727908089">Copy!</span>
                
            </span>
            </p>
            <p class="d-flex-s">
            <span>মোট টাকার পরিমাণ </span>
            <span class="bg2-t">৳{{$course->c_price}}</span>
            </p>
           
            </div>
      </div>
      
    </div>
    
  </div>
  <div class="method">
    <div> 
        <br>
        <form id="paymentForm" action="{{ route('author.payment.store') }}" method="POST">
          @csrf

          <input type="hidden" name="course_id" value="{{$course->id}}">

        <label for="number">নিচে আপনার মোবাইল মোবাইল নাম্বার লিখুন</label>
        <input 
        class="bg2"
        type="text"
        placeholder="মোবাইল নাম্বার"
        pattern="\d{11,}"
        minlength="11"
        maxlength="15"
        name="mobile_number"
        id="mobile_number"
        autocomplete="off"
        autofocus
        required
    >
    <br>
    <span class="error" id="error-message"></span>
    <br>
        <label for="number">নিচে ট্রান্সজেকশন আইডি</label>
        <input class="bg2"type="text"placeholder="ট্রান্সজেকশন আইডি" name="transaction_id" id="transaction_id"autocomplete="off"autofocus/> 
   <br>
   <br>
    </div>

    <style> :root {--bg1: #C90008; --bg2: #FFCDD2; } .bg1 {background-color: background-color: #03a9f5; } .bg2 {background-color: var(--bg2); color: var(--bg1); } .bg2-t {letter-spacing: -1px; color: var(--bg1); } input::placeholder {color: #c9c9c9; } </style>


  </div>
  <div class="bottom bg2" id="payment_submit_done">Confirm</div>
</from>
</div>

<!-- java script  -->
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('.text-to-clipboard').forEach(button => {
            button.addEventListener('click', function() {
                // Get the text value from the data attribute
                const text = this.getAttribute('data-value');
    
                // Create a temporary textarea element to hold the text
                const textarea = document.createElement('textarea');
                textarea.value = text;
                document.body.appendChild(textarea);
    
                // Select and copy the text
                textarea.select();
                document.execCommand('copy');
    
                // Remove the temporary textarea
                document.body.removeChild(textarea);
    
                // Optionally, show a message or change button text
                this.textContent = 'Copied!';
                setTimeout(() => {
                    this.textContent = 'Copy!'; // Change back after a short delay
                }, 2000);
            });
        });
    });

  
    </script>
      <script>
        document.getElementById('payment_submit_done').addEventListener('click', function() {
            var phoneNumberInput = document.getElementById('mobile_number');
            var phoneNumberValue = phoneNumberInput.value;
            var errorMessage = document.getElementById('error-message');

            // Validate input using regex
            var valid = /^\d{11,}$/.test(phoneNumberValue);

            if (valid) {
                // If valid, submit the form
                document.getElementById('paymentForm').submit();
            } else {
                // If not valid, show an error message
                errorMessage.textContent = "১১ ডিজিটের সঠিক নাম্বার লিখুন";
            }
        });
    </script>




<!-- java script  -->
   


@endsection

