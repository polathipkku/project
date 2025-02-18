<!DOCTYPE html>
<html>
<head>
    <title>ปฏิทินวันพระ</title>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js'></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-center mb-6">ปฏิทินวันพระ</h1>
        <div id='calendar' class="bg-white p-4 rounded-lg shadow"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'th',
                events: [
                    @foreach($holyDays as $day)
                    {
                        title: 'วันพระ ({{ $day->description }})',
                        start: '{{ $day->date->format('Y-m-d') }}',
                        className: 'bg-blue-200 text-blue-800'
                    },
                    @endforeach
                ]
            });
            calendar.render();
        });
    </script>
</body>
</html>