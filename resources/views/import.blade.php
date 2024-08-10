





<!DOCTYPE html>
<html>
<head>
    <title>Import/Export Questions</title>
</head>
<body>
    <h1>Import/Export Questions</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <!-- Import Form -->
    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" accept=".xlsx,.csv">
        <button type="submit">Import Questions</button>
    </form>

    <!-- Export Button -->
    <a href="{{ route('export') }}">Export Questions</a>
</body>
</html>
