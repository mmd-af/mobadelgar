@extends('site.layouts.index')
@section('schema')
    <script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "ItemList",
  "itemListElement": [
   @foreach($category->children as $key=> $child)
            {
              "@type": "ListItem",
              "position": {{$key+1}},
              "name": "{{$child->title}}",
      "url": "{{route('site.categories.child',['category'=>$category->slug,'slug'=>$child->slug])}}"
            }
            @if(!$loop->last)
                ,
            @endif
        @endforeach
        ]}




    </script>
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
    "name": "{{$category->title}}",
    "item": "{{route('site.categories.show',$category->slug)}}"
  }]
}




    </script>
@endsection
@section('style')
@endsection


@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">{{$category->title}}</li>
    <li class="breadcrumb-item"><a href="{{url('/')}}">خانه</a></li>
@endsection

@section('content')
    <div class="container">
        <h1 class="my-3"><strong>{{$category->title}}</strong></h1>
        <div class="row justify-content-center" id="root">
            <div class="row justify-content-center mt-5">
                <div class="spinner-grow text-primary m-2 p-4" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow text-primary m-2 p-4" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="row justify-content-center" id="second-load">
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
        let root = document.getElementById('root');
        let secondLoad = document.getElementById('second-load');
        setTimeout(function () {
            if (secondLoad) {
                secondLoad.innerHTML = `<div class="spinner-grow text-primary m-2 p-4" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow text-primary m-2 p-4" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>`;
            }
        }, 500);

        async function fetchData() {
            try {
                const headersConfig = {
                    parent_id: "{{$category->id}}",
                };
                const response = await axios.post("{{ route('site.categories.ajax.getCategories') }}", headersConfig);
                root.innerHTML = ``;
                response.data.data.forEach(insertDataInPage)

            } catch (error) {
                console.error('خطا در دریافت داده: ', error);
            }
        }

        function insertDataInPage(item) {
            let url = "{{route('site.categories.child',['category'=>$category->slug,':slug'])}}";
            url = url.replace(':slug', item.slug);
            root.innerHTML += `<div class="col-sm-6 col-md-4 grid-custom justify-content-center">
<a href="${url}" class="text-decoration-none">
                <div class="card">
                     <span class="icon">
                            <img src="${item.images.url}" class="img-fluid p-5" alt="Card title">
                     </span>
                    <h1 class="text-center mt-3"><strong>${item.title}</strong></h1>
                    <div class="background">
                        <div class="tiles">
                            <div class="tile tile-1"></div>
                            <div class="tile tile-2"></div>
                            <div class="tile tile-3"></div>
                            <div class="tile tile-4"></div>
                            <div class="tile tile-5"></div>
                            <div class="tile tile-6"></div>
                            <div class="tile tile-7"></div>
                            <div class="tile tile-8"></div>
                            <div class="tile tile-9"></div>
                            <div class="tile tile-10"></div>
                        </div>
                        <div class="line line-1"></div>
                        <div class="line line-2"></div>
                        <div class="line line-3"></div>
                    </div>
                </div>
</a>
            </div>`;
        }

        fetchData();

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
    </script>
@endsection
