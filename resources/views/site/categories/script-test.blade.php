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


                <div class="col-6">
                    <h1 class="mb-4">تبدیل واحد زمان</h1>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="inputValue" class="form-label">مقدار اولیه:</label>
                                <input type="number" class="form-control form-control-lg" id="inputValue"
                                       placeholder="مقدار اولیه وارد کنید - مثال = 60">
                            </div>
                            <div class="mb-3">
                                <label for="fromUnit" class="form-label">از واحد:</label>
                                <select class="form-control form-control-lg" id="fromUnit">
                                    <option value="s">ثانیه (s)</option>
                                    <option value="ks">کیلو ثانیه (ks)</option>
                                    <option value="ms">میلی ثانیه (ms)</option>
                                    <option value="μs">میکرو ثانیه (μs)</option>
                                    <option value="ns">نانو ثانیه (ns)</option>
                                    <option value="ps">پیکو ثانیه (ps)</option>
                                    <option value="min">دقیقه (min)</option>
                                    <option value="h">ساعت (h)</option>
                                    <option value="Day">روز (Day)</option>
                                    <option value="Week">هفته (Week)</option>
                                    <option value="Month">ماه (Month)</option>
                                    <option value="LunarMonth">ماه قمری</option>
                                    <option value="Year">سال (Year)</option>
                                    <option value="LunarYear">سال قمری</option>
                                    <option value="Decade">دهه (Decade)</option>
                                    <option value="Century">قرن (Century)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="toUnit" class="form-label">به واحد:</label>
                                <select class="form-control form-control-lg" id="toUnit">
                                    <option value="s">ثانیه (s)</option>
                                    <option value="ks">کیلو ثانیه (ks)</option>
                                    <option value="ms">میلی ثانیه (ms)</option>
                                    <option value="μs">میکرو ثانیه (μs)</option>
                                    <option value="ns">نانو ثانیه (ns)</option>
                                    <option value="ps">پیکو ثانیه (ps)</option>
                                    <option value="min">دقیقه (min)</option>
                                    <option value="h">ساعت (h)</option>
                                    <option value="Day">روز (Day)</option>
                                    <option value="Week">هفته (Week)</option>
                                    <option value="Month">ماه (Month)</option>
                                    <option value="LunarMonth">ماه قمری</option>
                                    <option value="Year">سال (Year)</option>
                                    <option value="LunarYear">سال قمری</option>
                                    <option value="Decade">دهه (Decade)</option>
                                    <option value="Century">قرن (Century)</option>
                                </select>
                            </div>
                            <div class="mt-5 p-5 text-center">
                                <label for="resultN">نتیجه:</label>
                                <br>
                                <h1 class="text-primary" id="result"></h1>
                            </div>

                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary px-5" id="convertBtn">تبدیل</button>
                    </div>
                </div>


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

        document.getElementById('convertBtn').addEventListener('click', function () {
            const inputValue = parseFloat(document.getElementById('inputValue').value);
            const fromUnit = document.getElementById('fromUnit').value;
            const toUnit = document.getElementById('toUnit').value;

            if (!isNaN(inputValue)) {
                const result = convertTimeUnit(inputValue, fromUnit, toUnit);
                document.getElementById('result').innerHTML = `${result}
                <button class="btn btn-outline-info" onclick="copyToClipboard(${result})"><i class="fa-regular fa-copy"></i></button>
                `;
            } else {
                document.getElementById('result').innerText = 'Invalid input';
            }
        });

        function convertTimeUnit(value, fromUnit, toUnit) {
            const conversions = {
                's': 1,
                'ks': 0.001,
                'ms': 1000,
                'μs': 1000000,
                'ns': 1000000000,
                'ps': 1000000000000,
                'min': 1 / 60,
                'h': 1 / 3600,
                'Day': 1 / 86400,
                'Week': 1 / 604800,
                'Month': 1 / 2628000,
                'LunarMonth': 1 / 2551442.884,
                'Year': 1 / 31536000,
                'LunarYear': 1 / 30617265.217,
                'Decade': 1 / 315360000,
                'Century': 1 / 3153600000
            };

            const result = value * conversions[toUnit] / conversions[fromUnit];
            return result;
        }

    </script>
@endsection
