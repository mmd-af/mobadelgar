@extends('admin.layouts.index')

@section('style')
@endsection

@section('title')
    index comments
@endsection

@section('content')
    <div class="container-fluid">
        <div class="mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست کامنت ها:</h5>
            </div>
            @include('admin.layouts.partials.errors')
            <div class="row">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">ردیف</th>
                        <th scope="col">ارسال کننده</th>
                        <th scope="col">متن کامنت</th>
                        <th scope="col">تاییدیه</th>
                        <th scope="col">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($comments as $key => $comment)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$comment->name}}</td>
                            <td>{{$comment->body}}</td>
                            <td>
                                <input onclick="updateComment({{$comment->id}})" type="checkbox" class="btn-check"
                                       id="checked-{{$comment->id}}" autocomplete="off"
                                       @if($comment->is_active) checked @endif>
                                <label class="btn btn-outline-success" for="checked-{{$comment->id}}">فعال</label>
                            </td>
                            <td>
                                <form
                                    action="{{route('admin.comments.destroy', ['comment' => $comment->id])}}"
                                    method="post"
                                    onsubmit="return showConfirm(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn text-danger">
                                        <i class="fa-solid fa-trash-can fa-xl"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>

     function updateComment(id) {
         const headersConfig = {
             id: id
         };
         axios.put("{{ route('admin.comments.ajax.activeComment')}}", headersConfig)
             .then(function (response) {
                 Swal.fire({
                     position: "top-end",
                     icon: "success",
                     title: "فعال/غیرفعال شد",
                     showConfirmButton: false,
                     timer: 1500
                 });
             })
             .catch(function (error) {
                 console.error('خطا در ارسال درخواست:', error);
             });


        }

        function showConfirm(event) {
            event.preventDefault();
            const form = event.target;
            Swal.fire({
                title: 'آیا از پاک کردن این اطلاعات مطمئن هستید؟',
                text: 'در صورت تایید برای همیشه پاک می شود',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'تایید',
                cancelButtonText: 'کنسل'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {

                }
            });
        }
        {{--document.addEventListener("DOMContentLoaded", function () {--}}

        {{--    axios.post("{{route('admin.comments.ajax.update')}}")--}}
        {{--        .then(response => {--}}
        {{--        }).catch(error => {--}}
        {{--        console.error(error)--}}
        {{--    });--}}
        {{--});--}}
    </script>
@endsection
