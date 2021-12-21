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

    @include('includes.auth-navbar')

    @yield('content')

   @include('includes.script')

</body>

</html>