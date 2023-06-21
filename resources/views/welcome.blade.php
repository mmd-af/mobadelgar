<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!-- Scripts -->
        @viteReactRefresh
        @vite(['resources/sass/site/app.scss', 'resources/js/site/app.js'])
    </head>
    <body>
  <div id="root"></div>
   </body>
</html>
