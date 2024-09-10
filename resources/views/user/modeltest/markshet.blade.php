<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marksheet</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <h1>Marksheet</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Subject ID</th>
                <th>Right Answers</th>
                <th>Wrong Answers</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subjects as $subject)
                <tr>
                    <td>{{ $subject->subject_name }}</td>
                    <td>{{ $subject->right_answers }}</td>
                    <td>{{ $subject->wrong_answers }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
