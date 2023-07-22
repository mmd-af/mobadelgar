@extends('site.layouts.index')
@section('title')
    صفحه ی اول
@endsection

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
                    <h1 class="mb-4">تبدیل واحد طول</h1>
                    <form id="conversionForm">
                        <div class="mb-3">
                            <label for="inputValue">مقدار:</label>
                            <input type="number" class="form-control form-control-lg" id="inputValue" required>
                        </div>
                        <div class="mt-5">
                            <label for="inputUnit">واحد اولیه:</label>
                            <select class="form-control form-control-lg" id="inputUnit" required>
                                <option value="mm">میلی‌متر (mm)</option>
                                <option value="cm">سانتی‌متر (cm)</option>
                                <option value="m">متر (m)</option>
                                <option value="km">کیلومتر (km)</option>
                                <option value="inch">اینچ (inch)</option>
                                <option value="foot">فوت (foot)</option>
                                <option value="yard">یارد (yard)</option>
                                <option value="mile">مایل (mile)</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="outputUnit">واحد مقصد:</label>
                            <select class="form-control form-control-lg" id="outputUnit" required>
                                <option value="mm">میلی‌متر (mm)</option>
                                <option value="cm">سانتی‌متر (cm)</option>
                                <option value="m">متر (m)</option>
                                <option value="km">کیلومتر (km)</option>
                                <option value="inch">اینچ (inch)</option>
                                <option value="foot">فوت (foot)</option>
                                <option value="yard">یارد (yard)</option>
                                <option value="mile">مایل (mile)</option>
                            </select>
                        </div>
                        <div class="mt-3 text-center">
                            <button type="submit" class="btn btn-primary px-5">تبدیل</button>
                        </div>
                    </form>
                    <div class="mt-5 p-5 text-center">
                        <label for="resultN">نتیجه:</label>
                        <br>
                        <h1 class="text-primary" id="resultN"></h1>
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
        document.getElementById('conversionForm').addEventListener('submit', function (event) {
            event.preventDefault();
            convertUnits();
        });

        function convertUnits() {
            const inputValue = parseFloat(document.getElementById('inputValue').value);
            const inputUnit = document.getElementById('inputUnit').value;
            const outputUnit = document.getElementById('outputUnit').value;

            const units = {
                mm: 0.001,
                cm: 0.01,
                m: 1,
                km: 1000,
                inch: 0.0254,
                foot: 0.3048,
                yard: 0.9144,
                mile: 1609.34,
            };

            if (!isNaN(inputValue) && units.hasOwnProperty(inputUnit) && units.hasOwnProperty(outputUnit)) {
                const result = (inputValue * units[inputUnit]) / units[outputUnit];
                document.getElementById('resultN').innerHTML = `${outputUnit + " " + result}
                    <button class="btn btn-outline-info" onclick="copyToClipboard(${result})"><i class="fa-regular fa-copy"></i></button>`;

            } else {
                document.getElementById('resultN').innerText = "خطا! لطفاً ورودی ها را چک کنید.";
            }
        }

        function copyToClipboard(result) {
            console.log(result)
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

    </script>
@endsection
