<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('_partials.master.head')
    </head>
    <body>
        @yield('master.content')

        @include('_partials.master.javascript')
    </body>
</html>
