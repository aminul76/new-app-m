<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('backend/styles.css') }}">
     <!-- jQuery -->
     <script src="{{ asset('plugins/jquery-3.6.0.min.js') }}"></script>
     <!-- DataTables CSS -->
     <link rel="stylesheet" type="text/css" href="{{ asset('plugins/jquery.dataTables.min.css') }}"/>
     <!-- DataTables JS -->
     <script type="text/javascript" charset="utf8" src="{{ asset('plugins/jquery.dataTables.min.js') }}"></script>
     <script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-MML-AM_CHTML">
     </script> 
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
