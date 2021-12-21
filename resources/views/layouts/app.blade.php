<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('includes.style')

    <title>Laracamp by BuildWith Angga</title>
</head>

<body>

    @include('includes.navbar')

    @yield('content')

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
   @include('includes.script')

</body>

</html>