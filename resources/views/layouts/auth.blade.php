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
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </section>
    </div>

    @include('includes.admin.script')

    @stack('addon-script')
</body>

</html>
