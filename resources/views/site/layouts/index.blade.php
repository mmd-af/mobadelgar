<!doctype html>
<html lang="en">
@include('site.layouts.partials.header')
<body>
@include('site.layouts.partials.navbar')
@yield('content')
@include('site.layouts.partials.footer')
<script src="{{ asset('jquery.min.js') }}"></script>
@yield('script')

</body>
</html>
