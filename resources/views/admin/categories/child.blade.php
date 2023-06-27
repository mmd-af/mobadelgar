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
            <div class="row mb-4">
                <div class="col-sm-6">
                    <form class="form-control" onsubmit="StoreCategoryScript();return false;"
                          method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="css">CSS:</label>
                                <textarea class="form-control" id="css"
                                          name="css">{{$child->scripts->css ?? null}}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="html">HTML:</label>
                                <textarea class="form-control" id="html"
                                          name="html">{{$child->scripts->html ?? null}}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="js">JS:</label>
                                <textarea class="form-control" id="js"
                                          name="js">{{$child->scripts->js ?? null}}</textarea>
                            </div>
                            <div class="form-group col-md-6 d-flex">
                                <button type="submit" class="btn btn-success w-50 btm-sm mt-2 mx-3">ثبت</button>
                                <button type="submit" class="btn btn-info w-50 btm-sm mt-2 mx-3"
                                        onclick="StoreCategoryScript();location.reload();">نمایش نتیجه
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6 border border-3 rounded-3">
                    <style>
                        {!! $child->scripts->css ?? null !!}
                    </style>
                    {!! $child->scripts->html ?? null !!}
                    <script>
                        {!! $child->scripts->js ?? null !!}
                    </script>


                </div>
            </div>
            <div id="showContentAlert"></div>
            <form action="" method="POST"
                  onsubmit="updateContentCategory();return false;">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-8 border border-3">
                        <div class="d-flex justify-content-between mt-3">
                            <label for="editor">توضیحات:</label>
                            <button class="btn" type="submit">
                                <i class="fa-solid fa-check fa-xl"></i>
                            </button>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <textarea class="form-control" id="editor"
                                          name="description">{{$child->description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 shadow">
                        <div class="form-group col-md-12">
                            <label for="meta_title">عنوان متا:</label>
                            <input class="form-control" id="meta_title" name="meta_title" type="text"
                                   value="{{ $child->meta_title }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="meta_description">توضیحات متا:</label>
                            <textarea class="form-control" id="word" maxlength="155" rows="5"
                                      name="meta_description">{{ $child->meta_description }}</textarea>
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
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    @include('admin.layouts.partials.script.ckeditor')
    @include('admin.layouts.partials.script.script')
    @include('admin.layouts.partials.script.wordCount')
    <script language="Javascript" type="text/javascript" src="{{asset('edit_area/edit_area_full.js')}}"></script>
    <script>
        editAreaLoader.init({
            id: "css",
            start_highlight: true,
            allow_resize: "both",
            allow_toggle: true,
            word_wrap: true,
            language: "en",
            syntax: "css"
        });
        editAreaLoader.init({
            id: "html",
            start_highlight: true,
            allow_resize: "both",
            allow_toggle: true,
            word_wrap: true,
            language: "en",
            syntax: "html"
        });
        editAreaLoader.init({
            id: "js",
            start_highlight: true,
            allow_resize: "both",
            allow_toggle: true,
            word_wrap: true,
            language: "en",
            syntax: "js"
        });

        let metaTitle = document.getElementById('meta_title');
        let metaDescription = document.getElementById('word');
        let showContentAlert = document.getElementById('showContentAlert');

        let css = document.getElementById('css');
        let html = document.getElementById('html');
        let js = document.getElementById('js');

        function StoreCategoryScript() {
            showContentAlert.innerHTML = `<div class="text-center">
                        <div class="spinner-border text-primary my-3"></div>
                    </div>`;
            const headersConfig = {
                categoryID: "{{$child->id}}",
                css: css.value,
                html: html.value,
                js: js.value,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            };
            axios.post("{{route('admin.categories.ajax.categoryScriptStore')}}", headersConfig)
                .then(response => {
                    showContentAlert.innerHTML = `<div class="alert alert-success">
                    <ul class="mb-0">
                        <li class="alert-text">اطلاعات ذخیره شد...</li>
                    </ul>
                </div>`;
                    setTimeout(removeDivContent, 5000);
                })
                .catch(error => {
                    showContentAlert.innerHTML = `<div class="alert alert-danger">
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
                    setTimeout(removeDivContent, 5000);
                });
        }

        function updateContentCategory() {
            showContentAlert.innerHTML = `<div class="text-center">
                        <div class="spinner-border text-primary my-3"></div>
                    </div>`;
            const headersConfig = {
                categoryID: "{{$child->id}}",
                description: editor.getData(),
                meta_title: metaTitle.value,
                meta_description: metaDescription.value,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            };
            axios.put("{{route('admin.categories.ajax.updateContentCategory')}}", headersConfig)
                .then(response => {
                    showContentAlert.innerHTML = `<div class="alert alert-success">
                    <ul class="mb-0">
                        <li class="alert-text">اطلاعات ذخیره شد...</li>
                    </ul>
                </div>`;
                    setTimeout(removeDivContent, 5000);
                })
                .catch(error => {
                    showContentAlert.innerHTML = `<div class="alert alert-danger">
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
                    setTimeout(removeDivContent, 5000);
                });
        }

        const formFields = [metaTitle, metaDescription];
        formFields.forEach((field) => {
            let typingTimer = null;
            field.oninput = function () {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(function () {
                    updateContentCategory();
                }, 3000);
            };
        });

        function removeDivContent() {
            showContentAlert.innerHTML = ``;
        }

        // $("#czFAQ").czMore();
    </script>
@endsection
