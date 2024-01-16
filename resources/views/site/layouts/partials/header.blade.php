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
    <style>
        .custom-box {
            background-color: rgba(255,255,255,0.5);
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .custom-box:hover {
            box-shadow: 0 0 20px rgba(0, 0, 255, 0.5); /* افزودن سایه با رنگ آبی */
            background-color: #007bff; /* تغییر رنگ به آبی هنگام هاور */
        }
    </style>
</head>
