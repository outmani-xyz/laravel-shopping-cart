<html>
    <head>
        <title>@yield('title')</title>
        <script src="{{ URL::to('js/jquery.min.js') }}" type="text/javascript"></script>

        <link href="{{ URL::to('bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <script src="{{ URL::to('bootstrap/bootstrap.min.js') }}" type="text/javascript"></script>
        @yield('style')
    </head>
    <body>
        @include('partials.header')
        @yield('content')
        @yield('scripts')
    </body>
</html>