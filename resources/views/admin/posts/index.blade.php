@extends('admin.layouts.index')

@section('style')
@endsection

@section('title')
    index posts
@endsection

@section('content')
    <div class="container-fluid">
        <div class="mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست دسته بندی ها:</h5>
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#createParentPost">
                    <i class="fa fa-plus"></i>
                    ایجاد مقاله
                </button>
            </div>
            @include('admin.layouts.partials.errors')
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-md-2 shadow rounded-3 m-4">
                        <div class="card m-3">
                            <div style="height: 250px;">
                                <img src="{{$post->images->url}}" class="img-thumbnail p-5" alt="...">
                            </div>
                            <div class="card-body">
                                <div class="card">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>{{ $post->title }}</strong></li>
                                        <li class="list-group-item">
                                        <span
                                            class="{{ $post->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                                        {{ $post->is_active }}
                                         </span>
                                        </li>
                                        <li class="list-group-item bg-secondary text-white rounded-3 small m-3 d-flex justify-content-between">
                                            <div class="p-1"><strong>ID: {{$post->id}}</strong></div>
                                            <button type="submit" onclick="moveContent({{$post->id}})"
                                                    class="btn link-warning"><i
                                                    class="fa-solid fa-arrow-right-arrow-left"></i></button>

                                        </li>
                                        <li class="list-group-item d-flex">
                                            <div class="mx-2">
                                                <a class="text-primary"
                                                   href="{{route('admin.posts.show', ['post' => $post->id])}}">
                                                    <i class="fa-regular fa-eye fa-xl mt-3"></i>
                                                </a>
                                            </div>
                                            <div class="mx-2">
                                                <a type="button" data-bs-toggle="modal"
                                                   data-bs-target="#editParentPost"
                                                   class="text-info mt-1"
                                                   onclick="getPost({{$post->id}})">
                                                    <i class="fa-regular fa-pen-to-square fa-xl"></i>
                                                </a>
                                            </div>
                                            <div class="mx-2">
                                                <form
                                                    action="{{route('admin.posts.destroy', ['post' => $post->id])}}"
                                                    method="post"
                                                    onsubmit="return showConfirm(event)"
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
    @include('admin.posts.create_post_modal')
    @include('admin.posts.edit_post_modal')
@endsection

@section('script')
    @include('admin.layouts.partials.script.script')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            axios.post("{{route('admin.posts.ajax.showAllNote')}}")
                .then(response => {
                    response.data.data.forEach((item) => {
                        let dateMiladi = item.created_at;
                        let dateShamsi = moment(dateMiladi).format('jYYYY/jM/jD');
                        noteShow.innerHTML += `<div class="card border-primary m-3">
        <div class="card-body">
            <p class="card-text">
<p>مربوط به: ${item.post.title}</p>
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
