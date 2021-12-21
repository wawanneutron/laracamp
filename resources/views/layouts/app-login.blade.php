<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('includes.style')

    <title>{{ $title ?? config('app.name') }} &dash; Situs Belajar Pemrograman Terstruktur dan Terbaik Indonesia</title>

</head>

<body>
    @yield('content')

   @include('includes.script')

</body>

</html>