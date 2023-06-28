@extends('site.layouts.index')
@section('title')
    صفحه ی اول
@endsection

@section('style')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center" id="root">
            <div class="row justify-content-center mt-5">
                <style>
                    {!! $category->scripts->css ?? null !!}
                </style>
                {!! $category->scripts->html ?? null !!}
                <script>
                    {!! $category->scripts->js ?? null !!}
                </script>
            </div>
            <div class="row justify-content-center" id="second-load">
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <hr class="bg-secondary py-5">
    </div>
    <div class="container py-5">
        <div class="row">
            {!! $category->description !!}
        </div>
    </div>
@endsection

@section('script')
    <script>

    </script>
@endsection
