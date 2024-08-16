<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/sign.css') }}">
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>


    <div class="sing-backround">
        <a href="{{url('/')}}" class="back-button">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <h1>Sign Your Account</h1>
        <div class="form-container">


            {{-- <form id="loginForm">
                @csrf
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>

            </form> --}}
            <div class="google-signin">
                <a href="{{ url('auth/google') }}" class="google-button">
                    <i class="fab fa-google google-icon"></i> Sign in with Google
                </a>
            </div>
            <div id="loginMessage"></div>

        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '/ajax-login',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#loginMessage').text(response.message);
                            window.location.href = '/home'; // Redirect to a secure page
                        } else {
                            $('#loginMessage').text(response.message);
                        }
                    },
                    error: function(response) {
                        $('#loginMessage').text('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>

</body>

</html>
