@extends('admin.layouts.index')

@section('title')
    show category
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h4 class="font-weight-bold mb-3 mb-md-0">{{$category->title}}</h4>
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#createParentCategory">
                    <i class="fa fa-plus"></i>
                    ایجاد دسته بندی
                </button>
            </div>
            @include('admin.layouts.partials.errors')


            <div class="row">
                @foreach ($childCategory as $childCat)
                    <div class="col-md-2 shadow rounded-3 m-4">
                        <div class="card m-3">
                            <div style="height: 250px;">
                                <img src="{{$childCat->images->url}}" class="img-thumbnail p-5" alt="...">
                            </div>
                            <div class="card-body">
                                <div class="card">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>{{ $childCat->title }}</strong></li>
                                        <li class="list-group-item">
                                        <span
                                            class="{{ $childCat->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                                        {{ $childCat->is_active }}
                                         </span>
                                        </li>
                                        <li class="list-group-item bg-secondary text-white rounded-3 small m-3 d-flex justify-content-between">
                                            <div class="p-1"><strong>ID: {{$childCat->id}}</strong></div>
                                            <button type="submit" onclick="moveContent({{$childCat->id}})"
                                                    class="btn link-warning"><i
                                                    class="fa-solid fa-arrow-right-arrow-left"></i></button>

                                        </li>
                                        <li class="list-group-item d-flex">
                                            <div class="mx-2">
                                                <a class="text-primary"
                                                   href="{{route('admin.categories.show', ['category' => $childCat->id])}}">
                                                    <i class="fa-regular fa-eye fa-xl mt-3"></i>
                                                </a>
                                            </div>
                                            <div class="mx-2">
                                                <a type="button" data-bs-toggle="modal"
                                                   data-bs-target="#editParentCategory"
                                                   class="text-info mt-1"
                                                   onclick="getCategory({{$childCat->id}})">
                                                    <i class="fa-regular fa-pen-to-square fa-xl"></i>
                                                </a>
                                            </div>
                                            <div class="mx-2">
                                                <form
                                                    action="{{route('admin.categories.destroy', ['category' => $childCat->id])}}"
                                                    method="post"
                                                    onsubmit="showConfirm()">
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


            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-8 border border-3">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="editor">توضیحات:</label>
                                <textarea class="form-control" id="editor"
                                          name="description">{!! old('description') !!}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 shadow">
                        {{--                        <div class="form-group col-md-12">--}}
                        {{--                            <label for="author_id">نام نویسنده</label>--}}
                        {{--                            <select class="form-control selectpicker" data-live-search="true" id="author_id"--}}
                        {{--                                    name="author_id">--}}
                        {{--                                <option--}}
                        {{--                                    value="{{auth()->user()->id}}">{{auth()->user()->name}} {{auth()->user()->faname}}</option>--}}
                        {{--                                @foreach($authors as $author)--}}
                        {{--                                    <option value="{{$author->id}}">{{$author->name}} {{$author->faname}}</option>--}}
                        {{--                                @endforeach--}}
                        {{--                            </select>--}}
                        {{--                        </div>--}}
                        <div class="form-group col-md-12">
                            <label for="meta_title">عنوان متا:</label>
                            <input class="form-control" id="meta_title" name="meta_title" type="text"
                                   value="{{ old('meta_title') }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="meta_description">توضیحات متا:</label>
                            <textarea class="form-control" id="word" maxlength="155" rows="5" autofocus
                                      name="meta_description">{{ old('meta_description') }}</textarea>
                            <div id="the-count">
                                <span id="current">0</span>
                                <span id="maximum">/155</span>
                            </div>
                            <p>تعداد کلمات:
                                <span id="show">0</span>
                            </p>
                        </div>
                        <div class="col-md-12 mt-5">
                            <div id="czFAQ"> ایجاد سوال (FAQ)
                                <div id="first">
                                    <div class="recordset">
                                        <div class="row">
                                            <div class="form-group col-md-12 shadow p-2">
                                                <label for="faq_question">سوال:</label>
                                                <input class="form-control" id="faq_question" name="faq_question[]"
                                                       type="text"
                                                       value="{{ old('faq_question[]') }}">

                                                <label for="faq_answer">جواب:</label>
                                                <input class="form-control" id="faq_answer" name="faq_answer[]"
                                                       type="text"
                                                       value="{{ old('faq_answer[]') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
                </div>
            </form>
        </div>
    </div>
    @include('admin.layouts.partials.script.create_parent_category_modal')
    @include('admin.layouts.partials.script.edit_parent_category_modal')
@endsection

@section('script')
    @include('admin.layouts.partials.script.ckeditor')
    @include('admin.layouts.partials.script.wordCount')
    <script>
        @include('admin.layouts.partials.script.script')
        let parentId = document.getElementById('parent_id');
        parentId.value = "{{$category->id}}";
    </script>
    <script>
        $("#czFAQ").czMore();
    </script>
@endsection
