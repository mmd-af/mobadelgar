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

            <div id="showContentAlert"></div>
            <form action="{{ route('admin.categories.store') }}" method="POST"
                  onsubmit="event.preventDefault();updateContentCategory()">
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

    <script>

        let metaTitle = document.getElementById('meta_title');
        let metaDescription = document.getElementById('word');
        let showContentAlert = document.getElementById('showContentAlert');

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

        parent_id.value = "{{$child->id}}";

        // $("#czFAQ").czMore();
    </script>
@endsection
