<!doctype html>
<html lang="fa">
@include('admin.layouts.partials.header')
<body>
@include('admin.layouts.partials.topbar')
@include('admin.layouts.partials.sidebar')
@if (Session::has('success'))
    <div class="container text-center">
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    </div>
@endif
@if (Session::has('error'))
    <div class="container text-center">
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    </div>
@endif
@yield('content')
@include('admin.layouts.partials.script.notes')
@include('admin.layouts.partials.footer')
<script src="{{ asset('jquery.min.js') }}"></script>
{{--<script src="{{ asset('axios.min.js') }}"></script>--}}
<script src="{{ asset('jquery.czMore-latest.js') }}"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
@yield('script')
<script>
    function deleteNote(id) {
        Swal.fire({
            title: 'آیا از پاک کردن این اطلاعات مطمئن هستید؟',
            text: 'در صورت تایید برای همیشه پاک می شود',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'تایید',
            cancelButtonText: 'کنسل'
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete("{{route('admin.notes.ajax.destroy', ['note' => ':id']) }}".replace(':id', id))
                    .then(response => {
                        location.reload();
                    });

            } else if (result.dismiss === Swal.DismissReason.cancel) {

            }
        });
    }
</script>
</body>
</html>
