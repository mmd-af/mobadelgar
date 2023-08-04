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
                    <h1>تبدیل واحد شارش جرمی</h1>
                    <div class="form-group">
                        <label for="inputMassFlow" class="form-label">مقدار شارش جرمی:</label>
                        <input type="number" class="form-control form-control-lg" id="inputMassFlow" placeholder="مقدار شارش جرمی" step="any" required>
                    </div>
                    <div class="form-group">
                        <label for="selectUnitFrom" class="form-label">واحد مبدا:</label>
                        <select class="form-control form-control-lg" id="selectUnitFrom" required>
                            <option value="kgPerSecond">کیلوگرم بر ثانیه (kg/s)</option>
                            <option value="gPerSecond">گرم بر ثانیه (g/s)</option>
                            <option value="tonPerHour">تن بر ساعت (ton/h)</option>
                          <option value="lbPerMinute">پوند بر دقیقه (lb/min)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="selectUnitTo" class="form-label">واحد مقصد:</label>
                        <select class="form-control form-control-lg" id="selectUnitTo" required>
                            <option value="kgPerSecond">کیلوگرم بر ثانیه (kg/s)</option>
                            <option value="gPerSecond">گرم بر ثانیه (g/s)</option>
                            <option value="tonPerHour">تن بر ساعت (ton/h)</option>
                            <option value="lbPerMinute">پوند بر دقیقه (lb/min)</option>
                        </select>
                    </div>
                </div>
                <div class="text-center">
                    <label for="result">نتیجه:</label>
                    <br>
                    <h1 class="text-primary" id="result"></h1>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary px-5" id="convertBtn" onclick="convertMassFlow()">تبدیل
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

        function convertMassFlow() {
            const inputMassFlow = parseFloat(document.getElementById("inputMassFlow").value);
            const unitFrom = document.getElementById("selectUnitFrom").value;
            const unitTo = document.getElementById("selectUnitTo").value;
            let outputMassFlow;

            switch (unitFrom) {
                case "kgPerSecond":
                    outputMassFlow = inputMassFlow;
                    break;
                case "gPerSecond":
                    outputMassFlow = inputMassFlow / 1000;
                    break;
                case "tonPerHour":
                    outputMassFlow = inputMassFlow / 3.6;
                    break;
                case "lbPerMinute":
                    outputMassFlow = inputMassFlow * 0.453592 / 60;
                    break;
                default:
                    outputMassFlow = "نا معتبر";
            }

            switch (unitTo) {
                case "kgPerSecond":
                    break;
                case "gPerSecond":
                    outputMassFlow *= 1000;
                    break;
                case "tonPerHour":
                    outputMassFlow *= 3.6;
                    break;
                case "lbPerMinute":
                    outputMassFlow /= 0.453592 * 60;
                    break;
                default:
                    outputMassFlow = "نا معتبر";
            }

            document.getElementById('result').innerHTML = `${outputMassFlow}
                 <button class="btn btn-outline-info" onclick="copyToClipboard(${outputMassFlow})"><i class="fa-regular fa-copy"></i></button>`;
        }
    </script>
@endsection
