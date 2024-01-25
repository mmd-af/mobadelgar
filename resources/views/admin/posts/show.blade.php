@extends('admin.layouts.index')

@section('title')
    show post
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h4 class="font-weight-bold mb-3 mb-md-0">{{$post->title}}</h4>
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#createParentPost">
                    <i class="fa fa-plus"></i>
                    ایجاد دسته بندی
                </button>
            </div>
            @include('admin.layouts.partials.errors')
            <form class="form-control bg-secondary py-3" onsubmit="StorePostInsidelink();return false;"
                  method="post">
                @csrf
                <div class="form-group col-md-12">
                    <label for="html">Insidelink:</label>
                    <textarea class="form-control" id="insidelink"
                              name="insidelink">{{$post->insidelinks->html ?? null}}</textarea>
                    <div class="form-group col-md-6 d-flex">
                        <button type="submit" class="btn btn-success w-50 btm-sm mt-2 mx-3">ثبت</button>
                    </div>
                </div>
            </form>
            <div id="showContentAlert"></div>
            <div class="row">
                <div class="col-sm-12 col-md-8 border border-3">
                    <div class="d-flex justify-content-between mt-3">
                        <label for="editor">توضیحات:</label>
                        <button class="btn" type="submit" onclick="updateContentPost()">
                            <i class="fa-solid fa-check fa-xl"></i>
                        </button>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                                <textarea class="form-control" id="editor"
                                          name="description">{{$post->description}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 shadow">
                    <div class="form-group col-md-12">
                        <label for="meta_title">عنوان متا:</label>
                        <input class="form-control" id="meta_title" name="meta_title" type="text"
                               value="{{ $post->meta_title }}">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="meta_description">توضیحات متا:</label>
                        <textarea class="form-control" id="word" maxlength="155" rows="5"
                                  name="meta_description">{{ $post->meta_description }}</textarea>
                        <div id="the-count">
                            <span id="current">0</span>
                            <span id="maximum">/155</span>
                        </div>
                        <p>تعداد کلمات:
                            <span id="show">0</span>
                        </p>
                    </div>
                    <div class="col-md-12 mt-5">
                        @foreach($post->faqs as $faq)
                            <div id="faq-destroy-{{$faq->id}}">
                                <a class="text-info border rounded-3 p-2 shadow" data-bs-toggle="collapse"
                                   href="#faq-{{$faq->id}}" role="button" aria-expanded="false"
                                   aria-controls="faq-{{$faq->id}}">
                                    <strong>{{$faq->question}}</strong>
                                </a>
                                <button type="submit" class="btn text-danger my-2" onclick="deleteFaq({{$faq->id}})">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>

                                <div class="collapse" id="faq-{{$faq->id}}">
                                    <div class="card card-body">
                                        {{$faq->answer}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div id="showFaqAlert"></div>
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
                        <button type="submit" class="btn btn-success mt-5" onclick="storePostFaq()">ثبت FAQ</button>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-12">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </div>
        </div>
    </div>
    @include('admin.posts.create_post_modal')
    @include('admin.posts.edit_post_modal')
@endsection

@section('note-store')
    <div class="mt-5">
        <form class="form-control" action="{{ route('admin.posts.noteStore') }}" method="post">
            @csrf
            <textarea name="description" class="form-control" id="description" cols="30" rows="3"
                      placeholder="یادداشت جدید بنویسید..."></textarea>
            <input type="hidden" name="id" id="id" value="{{$post->id}}">
            <button type="submit" class="btn btn-success mt-2">ثبت</button>
        </form>
    </div>
@endsection

@section('script')
    @include('admin.layouts.partials.script.ckeditor')
    @include('admin.layouts.partials.script.script')
    @include('admin.layouts.partials.script.wordCount')
    <script language="Javascript" type="text/javascript" src="{{asset('edit_area/edit_area_full.js')}}"></script>
    <script>
        let metaTitle = document.getElementById('meta_title');
        let metaDescription = document.getElementById('word');
        let showContentAlert = document.getElementById('showContentAlert');

        let parentId = document.getElementById('parent_id');
        parentId.value = "{{$post->id}}";

        editAreaLoader.init({
            id: "insidelink",
            start_highlight: true,
            allow_resize: "both",
            allow_toggle: true,
            word_wrap: true,
            language: "en",
            syntax: "html"
        });
        let insidelink = document.getElementById('insidelink');
        function StorePostInsidelink(){
            showContentAlert.innerHTML = `<div class="text-center">
                        <div class="spinner-border text-primary my-3"></div>
                    </div>`;
            const headersConfig = {
                postID: "{{$post->id}}",
                html: insidelink.value,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            };
            axios.post("{{route('admin.posts.ajax.postInsidelinkStore')}}", headersConfig)
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

        function updateContentPost() {
            showContentAlert.innerHTML = `<div class="text-center">
                        <div class="spinner-border text-primary my-3"></div>
                    </div>`;
            const headersConfig = {
                postID: "{{$post->id}}",
                description: editor.getData(),
                meta_title: metaTitle.value,
                meta_description: metaDescription.value,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            };
            axios.put("{{route('admin.posts.ajax.updateContentPost')}}", headersConfig)
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
                    updateContentPost();
                }, 3000);
            };
        });

        function removeDivContent() {
            showContentAlert.innerHTML = ``;
        }


        document.addEventListener("DOMContentLoaded", function () {
            const headersConfig2 = {
                id: "{{$post->id}}",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            };
            axios.post("{{route('admin.posts.ajax.showNote')}}", headersConfig2)
                .then(response => {
                    response.data.data.forEach((item) => {
                        let dateMiladi = item.created_at;
                        let dateShamsi = moment(dateMiladi).format('jYYYY/jM/jD');
                        noteShow.innerHTML += `<div class="card border-primary m-3">
            <div class="card-body">
                <p class="card-text">
                    <strong>
                       ${item.description}
                    </strong>
                </p>
            </div>
            <div class="d-flex justify-content-between m-3">
                <p>نویسنده: ${item.users.firstname} ${item.users.email}</p>
                <p>تاریخ: ${dateShamsi}</p>
                <i class="fa-solid fa-trash-can text-danger fa-lg mt-2" onclick="deleteNote(${item.id})"></i>
            </div>
        </div>`;
                    })
                }).catch(error => {
                console.error(error)
            });
        });
    </script>
@endsection
