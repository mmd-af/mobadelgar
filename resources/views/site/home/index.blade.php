@extends('site.layouts.index')
@section('title')
    صفحه ی اول
@endsection

@section('style')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center" style="margin-bottom: 250px" id="root">
        </div>
    </div>


@endsection

@section('script')
    <script>
        {{--const csrfToken = document.head.querySelector('meta[name="csrf-token"]').getAttribute('content');--}}
        {{--const headersConfig = {--}}
        {{--    headers: {--}}
        {{--        'X-CSRF-TOKEN': csrfToken--}}
        {{--    }--}}
        {{--};--}}
        {{--axios.get("{{ route('site.categories.ajax.getCategories') }}", headersConfig)--}}

        let root = document.getElementById('root');

        async function fetchData() {
            try {
                const response = await axios.get("{{ route('site.categories.ajax.getCategories') }}");


                console.log(response.data.data)
                response.data.data.forEach(insertDataInPage)

            } catch (error) {
                console.error('خطا در دریافت داده: ', error);
            }
        }

        function insertDataInPage(item) {
            console.log(item)

            let url = "{{route('site.categories.show',[':slug'])}}";
            url = url.replace(':slug', item.slug);
            root.innerHTML += `<div class="col-sm-6 col-md-4 grid-custom">
<a href="${url}" class="text-decoration-none">
                <div class="card">
                     <span class="icon">
                            <img src="${item.images.url}" class="img-fluid p-5" alt="Card title">
                     </span>
                    <h1 class="text-center text-primary mt-3">${item.title}</h1>
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
