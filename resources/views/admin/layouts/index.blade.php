<!doctype html>
<html lang="fa">
@include('admin.layouts.partials.header')
<body>
@include('admin.layouts.partials.topbar')
@include('admin.layouts.partials.sidebar')
@yield('content')
@include('admin.layouts.partials.script.notes')
@include('admin.layouts.partials.footer')
<script src="{{ asset('jquery.min.js') }}"></script>
<script src="{{ asset('jquery.czMore-latest.js') }}"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>

@yield('script')
</body>
</html>
