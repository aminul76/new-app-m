<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
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

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px 20px;
            background-color: #ffffff;
            color: #3a7bd5;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            z-index: 1;
        }

        .back-button:hover {
            background-color: #f0f0f0;
        }

        .container {
            position: relative;
            max-width: 600px;
            width: 100%;
        }

        .message {
            font-size: 24px;
            font-weight: bold;
        }

        .description {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <a href="javascript:history.back()" class="back-button">Go Back</a>
    <div class="container">
        <div class="message">404 Not Found</div>
        <div class="description">Oops! The page you're looking for doesn't exist.</div>
    </div>
</body>
</html>
