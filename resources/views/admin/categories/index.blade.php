@extends('admin.layouts.admin')

@section('title')
    index categories
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست دسته بندی ها: ({{ $categories->total() }})</h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.categories.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد دسته بندی
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام دسته بندی</th>
                        <th>نام انگلیسی</th>
                        <th>مرتبط</th>
                        <th>دسته</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $key => $category)
                        <tr>
                            <th>
                                {{ $categories->firstItem() + $key }}
                            </th>
                            <th>
                                {{ $category->title }}
                            </th>

                            <th>
                                {{ $category->slug }}
                            </th>
                            <th>
                                {{ $category->type }}
                            </th>
                            <th>
                                @if($category->parent_id <>0)
                                    <label class="text-success">{{$category->parent->title}}</label>
                                @else
                                    دسته ی مادر
                                @endif
                            </th>
                            <th>
                                <span
                                    class="{{ $category->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                                        {{ $category->is_active }}
                                </span>
                            </th>
                            <th>
                                <div class="d-flex justify-content-center">
                                    <div>
                                        <a class="btn btn-sm btn-outline-info ml-3"
                                           href="{{ route('admin.categories.edit', ['category' => $category->id]) }}">ویرایش</a>
                                    </div>
                                    <div>
                                        <form
                                            action="{{route('admin.categories.destroy', ['category' => $category->id])}}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger show_confirm">
                                                حذف
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $categories->render() }}
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script>
        $('.show_confirm').click(function (event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `آیا از پاک کردن این اطلاعات مطمئن هستید؟`,
                text: "در صورت تایید برای همیشه پاک می شود",
                icon: "error",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endsection
