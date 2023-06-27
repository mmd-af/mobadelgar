@extends('site.layouts.index')
@section('title')
    صفحه ی اول
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div id="root"></div>
            <div class="col-md-4">
                <div class="card m-5" style="width: 18rem;">
                    <img src="" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const headersConfig = {
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        };
        axios.get("{{ route('site.categories.ajax.getCategories') }}", headersConfig)
        {{--async function fetchData() {--}}
        {{--    try {--}}
        {{--        const response = await axios.get("{{ route('site.categories.ajax.getCategories') }}", headersConfig);--}}
        {{--        const root = document.getElementById('root');--}}
        {{--        root.innerHTML = response.data;--}}
        {{--    } catch (error) {--}}
        {{--        console.error('خطا در دریافت داده: ', error);--}}
        {{--    }--}}
        {{--}--}}

        // fetchData();
    </script>
@endsection
