<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    @yield('schema')
    @vite(['resources/css/site/app.scss', 'resources/js/site/app.js'])
    @yield('style')
    <script src="{{ asset('jquery.min.js') }}"></script>
    <script src="{{ asset('axios.min.js') }}"></script>
</head>
