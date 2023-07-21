@extends('site.layouts.index')
@section('title')
    صفحه ی اول
@endsection

@section('schema')
    {!! JsonLd::generate() !!}
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
@endsection

@section('script')
    <script>
        {!! $category->scripts->js ?? null !!}
    </script>
@endsection
