<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('backend/styles.css') }}">
     <!-- jQuery -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <!-- DataTables CSS -->
     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"/>
     <!-- DataTables JS -->
     <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>
<body>
    @include('backend.include.sidebar')
    <div class="main-content">
       @include('backend.include.header')
    
       
        @yield('content')
    </div>
  

  <script>
    $(document).ready(function() {
        $('#dTable').DataTable();
    });
</script>
</body>
</html>
