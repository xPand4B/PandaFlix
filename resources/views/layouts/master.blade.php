<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('_partials.master.head')
    </head>
    <body>
        @section('master.content')
        @show

        @include('_partials.master.javascript')
    </body>
</html>
