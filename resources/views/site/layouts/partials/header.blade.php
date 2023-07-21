<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> محاسبات و تبدیل تاریخ - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {{--    {!! Twitter::generate() !!}--}}
    {{--    {!! JsonLd::generate() !!}--}}
    {{--    {!! JsonLdMulti::generate() !!}--}}
    {{--    {!! JsonLd::generate() !!}--}}
    @yield('schema')
    @vite(['resources/css/site/app.scss', 'resources/js/site/app.js'])
    @yield('style')
</head>
