<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>test.com - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    @vite(['resources/css/admin/app.scss', 'resources/js/admin/app.js'])
    <script src="//cdn.ckeditor.com/4.21.0/full/ckeditor.js"></script>

    @yield('style')

</head>
