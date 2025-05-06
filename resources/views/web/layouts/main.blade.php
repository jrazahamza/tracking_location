<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Location Finder</title>
    <!-- Bootstrap 5 CSS -->
    @include('web.layouts.links')
    @yield('css')
</head>

<body>
    <!-- Header / Navbar -->
    @include('web.layouts.navbaar')
    @yield('content')

    @include('web.layouts.footer')

    @include('web.layouts.scripts')
    @yield('js')

</body>

</html>
