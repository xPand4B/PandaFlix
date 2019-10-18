<meta charset="utf-8" />
<meta name="author" content="Eric Heinzl">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, shrink-to-fit=no, user-scalable=0" name="viewport" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<link type="text/css" rel="stylesheet" href="{{ mix(asset('css/main.css')) }}">
@yield('master.stylesheet')

<title>{{ config('app.name') }} @hasSection ('master.title')| @yield('master.title')@endif</title>
