<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>test.com - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    @viteReactRefresh
    @vite(['resources/sass/admin/app.scss', 'resources/js/admin/app.js'])

    @yield('style')

</head>
