<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <style>
        /* ปรับขนาดปฏิทิน */
        #calendar {
            max-width: 600px; /* กำหนดความกว้าง */
            margin: 0 auto;   /* จัดให้อยู่ตรงกลาง */
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'th', // ใช้ภาษาไทย
                events: @json($events), // รับข้อมูล events จาก backend
            });

            calendar.render();
        });
    </script>
</head>
<body>
    <div id="calendar"></div>
</body>
</html>
