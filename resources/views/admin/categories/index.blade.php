@extends('admin.layouts.index')

@section('title')
    index categories
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست دسته بندی ها: ({{ $categories->total() }})</h5>
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#createParentCategory">
                    <i class="fa fa-plus"></i>
                    ایجاد دسته بندی
                </button>
            </div>
            @include('admin.layouts.partials.errors')
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
                                        <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#editParentCategory"
                                                class="btn btn-sm btn-outline-info ml-3"
                                                onclick="getCategory({{$category->id}})">
                                            ویرایش
                                        </button>
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
    @include('admin.layouts.partials.script.create_parent_category_modal')
    @include('admin.layouts.partials.script.edit_parent_category_modal')
@endsection
@section('script')

    <script>
        let showAlert = document.getElementById('show_alert');
        let title = document.querySelector('#editCategoryForm #title');
        let slug = document.querySelector('#editCategoryForm #slug');
        let image = document.querySelector('#editCategoryForm #image');
        let is_active = document.querySelector('#editCategoryForm #is_active');
        let category_id = document.querySelector('#editCategoryForm #category_id');

        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function getCategory(id) {
            showAlert.innerHTML = `<div class="text-center">
                        <div class="spinner-border text-primary my-3"></div>
                    </div>`;
            const headersConfig = {
                categoryID: id,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            };
            axios.post("{{route('admin.categories.ajax.getCategory')}}", headersConfig)
                .then(response => {
                    title.value = response.data.data.title;
                    slug.value = response.data.data.slug;
                    image.value = response.data.data.images.url;
                    is_active.value = response.data.data.is_active;
                    category_id.value = response.data.data.id;
                    showAlert.innerHTML = ``;
                }).catch(error => {
                console.error(error);
            });
        }

        document.getElementById('editCategoryForm').addEventListener('submit', function (event) {
            event.preventDefault();
            showAlert.innerHTML = `<div class="text-center">
                        <div class="spinner-border text-primary my-3"></div>
                    </div>`;
            const headersConfig = {
                categoryID: category_id.value,
                title: title.value,
                url: image.value,
                is_active: is_active.value,
                parent_id: 0,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            };
            axios.put("{{route('admin.categories.ajax.updateCategory')}}", headersConfig)
                .then(response => {
                    showAlert.innerHTML = `<div class="alert alert-success">
                    <ul class="mb-0">
                        <li class="alert-text">عملیات با موفقیت انجام شد</li>
                    </ul>
                </div>`;
                })
                .catch(error => {
                    showAlert.innerHTML = `<div class="alert alert-danger">
            <ul class="mb-0" id="showErrors">
                </ul>
                </div>`;
                    const obj = error.response.data.errors;
                    for (const key in obj) {
                        if (obj.hasOwnProperty(key)) {
                            const values = obj[key];
                            values.forEach(value =>
                                showErrors.innerHTML += `<li class="alert-text">${value}</li>`
                            );
                        }
                    }
                });
        });


        $('#editParentCategory').on('hidden.bs.modal', function (e) {
            location.reload();
        });

        $('.show_confirm').click(function (event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();

            // Swal.fire({
            //     title: 'Are you sure?',
            //     text: "You won't be able to revert this!",
            //     icon: 'warning',
            //     showCancelButton: true,
            //     confirmButtonColor: '#3085d6',
            //     cancelButtonColor: '#d33',
            //     confirmButtonText: 'Yes, delete it!'
            // })
            //

            Swal.fire({
                title: `آیا از پاک کردن این اطلاعات مطمئن هستید؟`,
                text: "در صورت تایید برای همیشه پاک می شود",
                icon: "error",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endsection
