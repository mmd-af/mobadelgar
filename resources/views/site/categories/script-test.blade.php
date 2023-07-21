@extends('site.layouts.index')
@section('title')
    صفحه ی اول
@endsection

@section('style')
    <style>





    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center" id="root">
            <div class="row justify-content-center mt-5">


                    <h1 class="text-center mt-5">Calendar</h1>
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <div id="calendar"></div>
                        </div>
                    </div>
                <script src="https://cdn.jsdelivr.net/npm/dayjs/plugin/weekday.min.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" integrity="sha512-liDnOrsa/NzR+4VyWQ3fBzsDBzal338A1VfUpQvAcdt+eL88ePCOd3n9VQpdA0Yxi4yglmLy/AmH+Lrzmn0eMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.9/dayjs.min.js" integrity="sha512-q4Xn+ZU2K+dqJPL8a3TiyGsDa31IkR/rLt/w+fy8jLrx8TdXj0dLM1Aq4aPXnOOKxHEya/bD9DePDB2DHm4jJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <hr class="bg-secondary py-5">
    </div>
    <div class="container py-5">
        <div class="row">
            توضیحاتش
        </div>
    </div>
@endsection

@section('script')
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [
                    {
                        title: 'Event 1',
                        start: '2023-07-01',
                        end: '2023-07-03'
                    },
                    {
                        title: 'Event 2',
                        start: '2023-07-05',
                        end: '2023-07-07'
                    },
                    {
                        title: 'Event 3',
                        start: '2023-07-10',
                        end: '2023-07-12'
                    }
                    // Add more events here...
                ]
            });

            calendar.render();
        });

    </script>
@endsection
