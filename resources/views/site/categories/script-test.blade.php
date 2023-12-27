@extends('site.layouts.index')

@section('schema')
    {!! JsonLd::generate() !!}
@endsection

@section('style')
    <style>

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center" id="root">
            <div class="row justify-content-center mt-5">

      <div id="dtp1"></div>

            </div>
        </div>
    </div>
    <div class="container-fluid">
        <hr class="bg-secondary py-5">
    </div>
    <div class="container bg-white rounded-3 p-5">

    </div>
@endsection

@section('script')
    <script>

        const dtp1Instance = new mds.MdsPersianDateTimePicker(document.getElementById('dtp1'), {
            targetTextSelector: '[data-name="dtp1-text"]',
            targetDateSelector: '[data-name="dtp1-date"]',
        });

    </script>
@endsection
