<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <title>Posty</title>
</head>
<body>
<x-navbar/>
@yield('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#navbar-toggle').click(() => {
            $('#navbar-collapse').toggleClass('translate-x-full md:translate-x-0');
        });
        $('#navbar-close').click(() => {
            $('#navbar-collapse').removeClass('translate-x-full md:translate-x-0');
        });
    });
</script>
@stack('scripts')
</body>
</html>
