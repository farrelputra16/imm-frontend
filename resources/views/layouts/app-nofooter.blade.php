<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMM | @yield('title')</title>
    <!-- CSS Umum -->
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    <!-- CSS Khusus Halaman -->
    @yield('css')


</head>
@include('layouts.navbar-peserta')

        @yield('content')


        </script>
</html>
