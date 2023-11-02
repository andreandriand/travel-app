<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.admin.meta')

    <title>LaraVel | @yield('title')</title>

    @include('includes.admin.style')

    @stack('addon-style')

</head>

<body>
    <div id="app">
        @include('sweetalert::alert')
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            @include('partials.admin.navbar')
            @include('partials.admin.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>

            @include('partials.admin.footer')

        </div>
    </div>

    @include('includes.admin.script')

    @stack('addon-script')
</body>

</html>
