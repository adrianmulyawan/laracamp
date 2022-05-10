<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('includes.meta')

    @stack('before-style')
    @include('includes.style')
    @stack('after-style')

    <title>@yield('title')</title>
</head>

<body>

    @yield('content')

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    {{-- Script --}}
    @stack('before-script')
    @include('includes.script')
    @stack('after-script')

</body>

</html>