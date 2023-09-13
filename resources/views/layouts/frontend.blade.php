<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.frontend.meta')

    <title>LaraVel | @yield('title')</title>

    @include('includes.frontend.style')

    @stack('addon-style')
</head>

<body>

    @yield('content')

    @include('partials.frontend.footer')

    @include('includes.frontend.script')

    @stack('addon-script')
</body>

</html>
