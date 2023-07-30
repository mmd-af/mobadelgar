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
@if (Session::has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'انجام شد',
            text: '{{ Session::get('success') }}',
        });
    </script>
@endif
@if (Session::has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'خطا!',
            text: '{{ Session::get('error') }}',
        });
    </script>
@endif
</body>
</html>
