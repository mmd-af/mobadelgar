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


                <div class="col-sm-12 col-lg-5">
                    <h1>تبدیل واحد چگالی</h1>
                    <div class="form-group">
                        <label for="density" class="form-label">چگالی</label>
                        <input type="text" class="form-control" id="density" placeholder="مقدار چگالی">
                    </div>
                    <div class="form-group">
                        <label for="fromUnit" class="form-label">واحد از</label>
                        <select class="form-select" id="fromUnit">
                            <option value="kg_per_m3">کیلوگرم بر متر مکعب (kg/m³)</option>
                            <option value="g_per_cm3">گرم بر سانتیمتر مکعب (g/cm³)</option>
                            <option value="lb_per_in3">پوند بر اینچ مکعب (lb/in³)</option>
                            <option value="g_per_L">گرم بر لیتر (g/L)</option>
                            <option value="kg_per_L">کیلوگرم بر لیتر (kg/L)</option>
                            <option value="mg_per_cm3">میلی‌گرم بر سانتیمتر مکعب (mg/cm³)</option>
                            <option value="lb_per_ft3">پوند بر فوت مکعب (lb/ft³)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="toUnit" class="form-label">واحد به</label>
                        <select class="form-select" id="toUnit">
                            <option value="kg_per_m3">کیلوگرم بر متر مکعب (kg/m³)</option>
                            <option value="g_per_cm3">گرم بر سانتیمتر مکعب (g/cm³)</option>
                            <option value="lb_per_in3">پوند بر اینچ مکعب (lb/in³)</option>
                            <option value="g_per_L">گرم بر لیتر (g/L)</option>
                            <option value="kg_per_L">کیلوگرم بر لیتر (kg/L)</option>
                            <option value="mg_per_cm3">میلی‌گرم بر سانتیمتر مکعب (mg/cm³)</option>
                            <option value="lb_per_ft3">پوند بر فوت مکعب (lb/ft³)</option>
                        </select>
                    </div>
                </div>
                <div class="text-center">
                    <label for="result">نتیجه:</label>
                    <br>
                    <h1 class="text-primary" id="result"></h1>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary px-5" id="convertBtn" onclick="convertDensity()">تبدیل
                    </button>
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

        function convertDensity() {
            // خواندن مقدار چگالی از فیلد ورودی
            const density = parseFloat(document.getElementById("density").value);

            // خواندن واحد‌های انتخاب شده از لیست‌ها
            const fromUnit = document.getElementById("fromUnit").value;
            const toUnit = document.getElementById("toUnit").value;

            // تعریف ضریب تبدیل بین واحدها
            const conversionFactors = {
                kg_per_m3: 1,
                g_per_cm3: 1000,
                lb_per_in3: 0.0361273,
                g_per_L: 1000,
                kg_per_L: 1,
                mg_per_cm3: 1e+6,
                lb_per_ft3: 0.0624279,
            };

            // تبدیل مقدار چگالی به واحدهای مورد نظر
            const result = density * conversionFactors[fromUnit] / conversionFactors[toUnit];

            document.getElementById('result').innerHTML = `${result}
                 <button class="btn btn-outline-info" onclick="copyToClipboard(${result})"><i class="fa-regular fa-copy"></i></button>`;
        }

    </script>
@endsection
