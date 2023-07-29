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

                <div class="col-sm-12 col-lg-6">
                    <h1 class="mb-4">تبدیل واحدهای زاویه</h1>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="inputAngle">زاویه را وارد کنید:</label>
                            <input type="number" class="form-control" id="inputAngle"
                                   placeholder="زاویه را وارد کنید...">
                        </div>
                        <div class="col-md-4">
                            <label for="selectFrom">از:</label>
                            <select class="form-control" id="selectFrom">
                                <option value="degree">درجه (°)</option>
                                <option value="radian">رادیان (rad)</option>
                                <option value="gradian">گراد (gon)</option>
                                <option value="arcsecond">ثانیه قوسی (arcsec)</option>
                                <option value="arcminute">دقیقه قوسی (arcmin)</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="selectTo">به:</label>
                            <select class="form-control" id="selectTo">
                                <option value="degree">درجه (°)</option>
                                <option value="radian">رادیان (rad)</option>
                                <option value="gradian">گراد (gon)</option>
                                <option value="arcsecond">ثانیه قوسی (arcsec)</option>
                                <option value="arcminute">دقیقه قوسی (arcmin)</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <button class="btn btn-primary" onclick="convertAngle()">تبدیل</button>
                        </div>
                        <div class="col-md-6">
                            <h4>نتیجه:</h4>
                            <p id="result"></p>
                        </div>
                    </div>
                </div>

                {{--                <div class="mt-5 p-5 text-center">--}}
                {{--                    <label for="result">نتیجه:</label>--}}
                {{--                    <br>--}}
                {{--                    <h1 class="text-primary" id="result"></h1>--}}
                {{--                </div>--}}
                {{--                <div class="text-center">--}}
                {{--                    <button class="btn btn-primary px-5" id="convertBtn" onclick="convertWeight()">تبدیل--}}
                {{--                    </button>--}}
                {{--                </div>--}}


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
        function copyToClipboard(result) {
            navigator.permissions.query({name: "clipboard-write"}).then(resultC => {
                if (resultC.state === "granted" || resultC.state === "prompt") {
                    navigator.clipboard.writeText(result)
                        .then(() => {
                            alert("مقدار با موفقیت در کلیپ‌بورد ذخیره شد!");
                        })
                        .catch(err => {
                            alert("خطا در ذخیره‌سازی مقدار در کلیپ‌بورد:", err);
                        });
                } else {
                    alert("عدم دسترسی به کلیپ‌بورد!");
                }
            });
        }

        function convertAngle() {
            const inputAngle = parseFloat(document.getElementById("inputAngle").value);
            const fromUnit = document.getElementById("selectFrom").value;
            const toUnit = document.getElementById("selectTo").value;

            // نرخ‌های تبدیل از درجه (°)
            const conversionRates = {
                degree: 1,
                radian: Math.PI / 180,
                gradian: 0.9,
                arcsecond: 3600,
                arcminute: 60
            };

            // انجام تبدیل
            const result = (inputAngle * conversionRates[fromUnit]) / conversionRates[toUnit];
            console.log(inputAngle, conversionRates[fromUnit], conversionRates[toUnit])
            // واحدها به فارسی
            const unitsInPersian = {
                degree: "درجه",
                radian: "رادیان",
                gradian: "گراد",
                arcsecond: "ثانیه قوسی",
                arcminute: "دقیقه قوسی"
            };

            document.getElementById("result").innerText = result + " " + unitsInPersian[toUnit];
        }


    </script>
@endsection
