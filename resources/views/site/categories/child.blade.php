@extends('site.layouts.index')

@section('schema')
{{--    {!! JsonLd::generate() !!}--}}
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
@endsection

@section('style')
    <style>
        {!! $category->scripts->css ?? null !!}
    </style>
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
