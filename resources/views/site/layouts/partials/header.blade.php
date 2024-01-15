<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    @yield('schema')
    <link rel="stylesheet" href="{{asset('build/css/site.css')}}">
    @yield('style')
</head>
