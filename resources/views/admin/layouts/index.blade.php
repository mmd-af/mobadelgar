<!doctype html>
<html lang="en">


@include('admin.layouts.partials.header')

<body dir="rtl">

<div class="wrapper d-flex align-items-stretch">

@include('admin.layouts.partials.sidebar')



<!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">

        @include('admin.layouts.partials.topbar')


        @yield('content')

    </div>

</div>
@include('admin.layouts.partials.footer')

<script src="{{ asset('jquery.min.js') }}"></script>
<script src="{{ asset('jquery.czMore-latest.js') }}"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
@yield('script')

</body>
</html>
