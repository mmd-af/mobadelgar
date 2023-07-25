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
    <li class="breadcrumb-item"><a href="{{url('/')}}">خانه</a></li>
    <li class="breadcrumb-item"><a
            href="{{route('site.categories.show',$category->parent->slug)}}">{{$category->parent->title}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$category->title}}</li>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center" id="root">
            <div class="row justify-content-center mt-5">
                {!! $category->scripts->html ?? null !!}
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <hr class="bg-secondary py-5">
    </div>
    <div class="container bg-white rounded-3 p-5">
        {!! $category->description !!}
    </div>
    <div class="container bg-white rounded-3 p-5">
        @foreach($category->faqs as $faq)
            <div class="row">
                <a class="text-info border rounded-3 p-2 shadow text-decoration-none" data-bs-toggle="collapse"
                   href="#faq-{{$faq->id}}" role="button" aria-expanded="false"
                   aria-controls="faq-{{$faq->id}}">
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
@endsection

@section('script')
    <script>
        {!! $category->scripts->js ?? null !!}
    </script>
@endsection
