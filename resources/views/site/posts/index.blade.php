@extends('site.layouts.index')

@section('schema')
    <script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "WebSite",
  "name": "مبدل گر- ابزارهای آنلاین رایگان، سرگرمی ها و اطلاعات متنوع",
  "url": "https://mobadelgar.ir",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "{search_term_string}",
    "query-input": "required name=search_term_string"
  }
}

    </script>
@endsection

@section('style')
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">وبلاگ</li>
    <li class="breadcrumb-item"><a href="{{url('/')}}">خانه</a></li>
@endsection

@section('content')
    <div class="container">
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
                    parent_id: 0,
                };
                const response = await axios.post("{{ route('site.posts.ajax.getPosts') }}", headersConfig);
                root.innerHTML = ``;
                response.data.data.forEach(insertDataInPage)

            } catch (error) {
                console.error('خطا در دریافت داده: ', error);
            }
        }

        function insertDataInPage(item) {
            let url = "{{route('site.posts.show',[':slug'])}}";
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
    </script>
@endsection
