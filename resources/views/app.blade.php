<!DOCTYPE html>
<html>
<head>
    <title>My Application - @yield('title')</title>
    <!-- Include your CSS files here -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @include('partials.header')
    @include('partials.navbar')

    <div class="container">
        @yield('content')
    </div>

    @include('partials.footer')

    <!-- Include your JS files here -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
