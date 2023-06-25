@extends('admin.layouts.index')

@section('title')
    show category
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h4 class="font-weight-bold mb-3 mb-md-0">{{$child->title}}</h4>

            </div>
            @include('admin.layouts.partials.errors')


            <div class="row">

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
    {{--    @include('admin.layouts.partials.script.ckeditor')--}}
    @include('admin.layouts.partials.script.wordCount')
    @include('admin.layouts.partials.script.script')
    <script>
        $("#czFAQ").czMore();
    </script>
@endsection
