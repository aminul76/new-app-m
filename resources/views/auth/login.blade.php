<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<form id="loginForm">
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

</form>
<a href="{{ url('auth/google') }}" class="btn btn-primary">
    Login with Google
</a>
<div id="loginMessage"></div>
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
