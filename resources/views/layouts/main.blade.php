<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     
    @include('includes.style');

    <title>Halal-Store</title>
</head>

<body>
    <!-- navbar -->
  @include('includes.navbar');
    <!-- akhir navbar -->
    @yield('content')
    <!-- footer -->
  @include('includes.footer')
    <!-- akhir footer -->
    @include('includes.script');
    @include('sweetalert::alert')






  
</body>

</html>