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


                <div class="col-md-6">
                    <h3>Miladi to Shamsi</h3>
                    <div class="input-group mb-3">
                        <input type="text" id="miladiInput" class="form-control" placeholder="YYYY-MM-DD">
                        <button class="btn btn-primary" onclick="convertToShamsi()">Convert</button>
                    </div>
                    <p id="shamsiResult"></p>
                </div>
                <div class="col-md-6">
                    <h3>Shamsi to Miladi</h3>
                    <div class="input-group mb-3">
                        <input type="text" id="shamsiInput" class="form-control" placeholder="YYYY/MM/DD">
                        <button class="btn btn-primary" onclick="convertToMiladi()">Convert</button>
                    </div>
                    <p id="miladiResult"></p>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

        const persianDatepickerMiladi = new PersianDatepicker('#miladiInput', {
            format: 'YYYY-MM-DD',
            observer: true,
            autoClose: true
        });

        const persianDatepickerShamsi = new PersianDatepicker('#shamsiInput', {
            format: 'YYYY/MM/DD',
            observer: true,
            autoClose: true
        });

        function convertToShamsi() {
            const miladiInput = document.getElementById('miladiInput').value;
            const shamsiDate = moment(miladiInput, 'YYYY-MM-DD').format('jYYYY/jM/jD');
            document.getElementById('shamsiResult').innerText = "Shamsi Date: " + shamsiDate;
        }

        function convertToMiladi() {
            const shamsiInput = document.getElementById('shamsiInput').value;
            const miladiDate = moment(shamsiInput, 'jYYYY/jM/jD').format('YYYY-MM-DD');
            document.getElementById('miladiResult').innerText = "Miladi Date: " + miladiDate;
        }

    </script>
@endsection
