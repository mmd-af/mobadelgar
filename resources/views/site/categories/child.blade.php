@extends('site.layouts.index')

@section('schema')
    {!! $category->schemas->json_ld ?? null !!}
    @if ($category->faqs->count() > 0)
        <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
  @foreach($category->faqs as $faq)
                {
                  "@type": "Question",
                  "name": "{{$faq->question}}",
    "acceptedAnswer": {
      "@type": "Answer",
      "text": "{{$faq->answer}}"
                }
              }
              @if(!$loop->last)
                    ,
@endif
            @endforeach
            ]
           }

        </script>
    @endif
    <script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "name": "خانه",
    "item": "{{url('/')}}"
  },{
    "@type": "ListItem",
    "position": 2,
    "name": "{{$category->parent->title}}",
    "item": "{{route('site.categories.show',$category->parent->slug)}}"
  },{
    "@type": "ListItem",
    "position": 3,
    "name": "{{$category->title}}",
    "item": "{{route('site.categories.child',[$category->parent->slug,$category->slug])}}"
  }]
}

    </script>
@endsection

@section('style')
    <style>
        {!! $category->scripts->css ?? null !!}
    </style>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">{{$category->title}}</li>
    <li class="breadcrumb-item"><a
            href="{{route('site.categories.show',$category->parent->slug)}}">{{$category->parent->title}}</a></li>
    <li class="breadcrumb-item"><a href="{{url('/')}}">خانه</a></li>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center" id="root">
            <div class="row justify-content-center mt-5">
                {!! $category->scripts->html ?? null !!}
            </div>
        </div>
    </div>
    <div class="container-fluid bg-secondary py-5 my-5">
    </div>
    <div class="container py-5">
        {!! $category->description !!}
    </div>
    <div class="container accordion my-3">
        <h3 class="mb-2">سوالات متداول:</h3>
        @foreach($category->faqs as $faq)
            <div class="row">
                <a class="text-info border rounded-3 p-2 shadow text-decoration-none" data-bs-toggle="collapse"
                   href="#faq-{{$faq->id}}" role="button" aria-expanded="false"
                   aria-controls="faq-{{$faq->id}}">
                    <i class="fa-solid fa-plus fa-xl mx-2 plusIcon"></i>
                    <i class="fa-solid fa-minus fa-xl mx-2 minusIcon d-none"></i>
                    <strong>{{$faq->question}}</strong>
                </a>
                <div class="collapse" id="faq-{{$faq->id}}">
                    <div class="mt-2 mb-4">
                        {{$faq->answer}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @include('site.comments.index')
@endsection

@section('script')
    <script>
        {!! $category->scripts->js ?? null !!}

            const accordion = document.querySelector('.accordion');
        accordion.addEventListener('shown.bs.collapse', function (event) {
            const plusIcon = event.target.previousElementSibling.querySelector('.plusIcon');
            const minusIcon = event.target.previousElementSibling.querySelector('.minusIcon');
            plusIcon.classList.toggle('d-none');
            minusIcon.classList.toggle('d-none');
        });
        accordion.addEventListener('hidden.bs.collapse', function (event) {
            const plusIcon = event.target.previousElementSibling.querySelector('.plusIcon');
            const minusIcon = event.target.previousElementSibling.querySelector('.minusIcon');
            plusIcon.classList.toggle('d-none');
            minusIcon.classList.toggle('d-none');
        });

        let commentBox = document.getElementById('commentBox');

        async function fetchCommentData() {
            try {
                const headersConfig = {
                    commentableId: {{$category->id}},
                    parent_id: 0
                };
                const response = await axios.post("{{ route('site.comments.ajax.getComments') }}", headersConfig);
                commentBox.innerHTML = ``;
                response.data.data.forEach(insertDataInComments)

            } catch (error) {
                console.error('خطا در دریافت داده: ', error);
            }
        }

        fetchCommentData();

        function insertDataInComments(item) {
            var inputTime = item.created_at;
            var dateObject = new Date(inputTime);
            var formattedDate = dateObject.toLocaleString();
            commentBox.innerHTML += `<div class="d-flex flex-start mt-4">
                                <i class="fa-regular fa-user fa-2x shadow-lg h-100"></i>
                                <div class="flex-grow-1 flex-shrink-1">
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="mb-1 mx-3">
                                            ${item.name}
                                                <span class="small"> ${formattedDate} </span>
                                            </p>
<!--                                            <a href="#!"><i class="fas fa-reply fa-xs"></i><span-->
<!--                                                    class="small">پاسخ</span></a>-->
                                        </div>
                                        <p class="small mb-0">
                                            ${item.body}
                                        </p>
                                    </div>

                                    <div class="d-flex flex-start mt-4" id="childComment">

                                    </div>


                                </div>
                            </div>`;
        }
        // TODO childComment not runnig this is ready for run
        let childCommentEEEE = `            <a class="me-3" href="#">
                                            <i class="fa-solid fa-user fa-2x"></i>
                                        </a>
                                        <div class="flex-grow-1 flex-shrink-1">
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="mb-1 mx-3">
                                                        پاسخ محمد افشار
                                                        <span class="small">- 4 hours ago</span>
                                                    </p>
                                                </div>
                                                <p class="small mb-0">
                                                    جواب کامنت طولانیجواب کامنت طولانیجواب کامنت طولانیجواب کامنت
                                                    طولانیجواب کامنت طولانیجواب کامنت طولانیجواب کامنت طولانی
                                                </p>
                                            </div>
                                        </div>`;
        let childComment = document.getElementById('childComment');
        // console.log(childComment)
        document.getElementById('commentForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const headersConfig = {
                commentableId: {{$category->id}},
                parent_id: 0,
                name: document.getElementById('name').value,
                commentText: document.getElementById('commentText').value
            };
            axios.post("{{ route('site.comments.ajax.storeComments')}}", headersConfig)
                .then(function (response) {
                    document.getElementById('name').value = '';
                    document.getElementById('commentText').value = '';
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "کامنت شما با موفقیت ثبت شد و بعد از تایید ادمین در سایت نشان داده خواهد شد.",
                        showConfirmButton: false,
                        timer: 4000
                    });
                })
                .catch(function (error) {
                    console.error('خطا در ارسال درخواست:', error);
                });
        });
    </script>
@endsection
