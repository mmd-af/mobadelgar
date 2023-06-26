@extends('admin.layouts.index')

@section('style')
@endsection

@section('title')
    index categories
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست دسته بندی ها:</h5>
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#createParentCategory">
                    <i class="fa fa-plus"></i>
                    ایجاد دسته بندی
                </button>
            </div>
            @include('admin.layouts.partials.errors')
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-md-2 shadow rounded-3 m-4">
                        <div class="card m-3">
                            <div style="height: 250px;">
                                <img src="{{$category->images->url}}" class="img-thumbnail p-5" alt="...">
                            </div>
                            <div class="card-body">
                                <div class="card">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>{{ $category->title }}</strong></li>
                                        <li class="list-group-item">
                                        <span
                                            class="{{ $category->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                                        {{ $category->is_active }}
                                         </span>
                                        </li>
                                        <li class="list-group-item bg-secondary text-white rounded-3 small m-3 d-flex justify-content-between">
                                            <div class="p-1"><strong>ID: {{$category->id}}</strong></div>
                                            <button type="submit" onclick="moveContent({{$category->id}})"
                                                    class="btn link-warning"><i
                                                    class="fa-solid fa-arrow-right-arrow-left"></i></button>

                                        </li>
                                        <li class="list-group-item d-flex">
                                            <div class="mx-2">
                                                <a class="text-primary"
                                                   href="{{route('admin.categories.show', ['category' => $category->id])}}">
                                                    <i class="fa-regular fa-eye fa-xl mt-3"></i>
                                                </a>
                                            </div>
                                            <div class="mx-2">
                                                <a type="button" data-bs-toggle="modal"
                                                   data-bs-target="#editParentCategory"
                                                   class="text-info mt-1"
                                                   onclick="getCategory({{$category->id}})">
                                                    <i class="fa-regular fa-pen-to-square fa-xl"></i>
                                                </a>
                                            </div>
                                            <div class="mx-2">
                                                <form
                                                    action="{{route('admin.categories.destroy', ['category' => $category->id])}}"
                                                    method="post"
                                                    onsubmit="showConfirm()"
                                                >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn text-danger">
                                                        <i class="fa-solid fa-trash-can fa-xl"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('admin.layouts.partials.script.create_parent_category_modal')
    @include('admin.layouts.partials.script.edit_parent_category_modal')
@endsection

@section('script')
    @include('admin.layouts.partials.script.script')
@endsection
