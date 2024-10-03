<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>পেমেন্ট চেকিং</title>
    <style>
       body {
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #3a7bd5, #00d2ff);
    color: white;
    font-family: Arial, sans-serif;
    text-align: center;
    position: relative;
}

.container {
    max-width: 600px;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.message {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px; /* Adds space between message and description */
}

.description {
    font-size: 18px;
    margin-bottom: 20px; /* Adds space between description and button */
}

.back-button {
    padding: 10px 20px;
    background-color: #ffffff;
    color: #3a7bd5;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    font-size: 16px;
}

.back-button:hover {
    background-color: #f0f0f0;
}
    </style>
</head>
<body>
   
    <div class="container">
        @if ($already==0)
        <div class="message"><h1>ধন্যবাদ</h1></div>
        <div class="description"><h2>পেমেন্ট চেকিং অবস্থায় আছে। কিছু সময় অপেক্ষা করুন । কোর্সটি একটিভ হলে আপনার মোবাইলে ম্যাসেজ আসবে </h2></div>
        <a href="{{ url('/courses', $course->c_slug) }}" class="back-button">HOME</a>
        @else
        <div class="message"><h1>আপনি অলরেডি এপ্লাই করছেন।</h1></div>
        <div class="description"><h2>আডমিন পেমেন্ট চেক করে আপ্রুভ করবে। আপ্রুভ হলে ম্যাসেস পাবেন মোবাইলে। দয়া করে অপেক্ষা করুন </h2></div>
        <a href="{{ url('/courses', $course->c_slug) }}" class="back-button">HOME</a>
        @endif
        
    </div>
</body>
</html>
