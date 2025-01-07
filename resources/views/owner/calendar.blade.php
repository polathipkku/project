<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        #calendar {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'th', // ใช้ภาษาไทย
                events: @json($events), // รับข้อมูล events จาก backend
                eventClassNames: function(info) {
                    if (info.event.extendedProps.type === 'checkout') {
                        return ['bg-red-500', 'text-red-800', ]; // คลาส Tailwind CSS
                    }
                    return [];
                },
            });

            calendar.render();
        });
    </script>

</head>

<body class="bg-gray-100">
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-2xl">
            <h1 class="text-2xl font-semibold text-gray-800 text-center mb-4">
                ปฏิทินการจองห้องพัก
            </h1>

            <!-- ปุ่มย้อนกลับ -->
            <button onclick="window.history.back();" class="mb-4 py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-700">
                ย้อนกลับ
            </button>

            <div id="calendar"></div>
        </div>
    </div>
</body>


</html>