<!doctype html>
<html lang="en">
@include('site.layouts.partials.header')
<body>
@include('site.layouts.partials.navbar')
@yield('content')
@include('site.layouts.partials.footer')
@yield('script')
</body>
</html>
