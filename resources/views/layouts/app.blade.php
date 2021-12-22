<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" href="{{ asset('inscription/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('inscription/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('inscription/css/bootstrap.min.css') }}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('inscription/css/style.css') }}">

    <title>{{$title}}</title>
  </head>
  <body>
  <div class="d-lg-flex half">
      @yield('context')
  </div>
  <script src="{{ asset('inscription/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('inscription/js/popper.min.js') }}"></script>
  <script src="{{ asset('inscription/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('inscription/js/main.js') }}"></script>
</body>
</html>