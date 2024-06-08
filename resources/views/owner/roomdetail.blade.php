<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/hero.css">

    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>
    <title>Tunthree</title>
</head>

<body>
    <div style="display: flex; background-color: #F5F3FF;">

    <x-aside /> 

        <!-- --------------------------------------------------------------------------------------------------------------------- -->

        <section class="ml-10 bg-white" id="room-table" style="width:1100px; padding-left: 2.5%; padding-right: 2.5%;">
            <div class="max-w-screen-xl mx-auto py-10 ">
                <div class="px-2 p-2  flex justify-between items-center">
                    <h1 class="text-4xl mb-10 max-xl:px-4">รายละเอียดห้องพัก</h1>
                    <button class="relative pr-12 mb-4 group" onclick="window.location.href ='/room'">
                        <i class="fa-solid fa-circle-xmark text-4xl text-red-500 group-hover:text-red-900"></i>
                    </button>

                </div>
                <table class="w-full border-collapse ">
                    <thead>
                        <tr class="text-l bg-gray-300">
                            <th class="px-4 py-2">หมายเลขห้อง</th>
                            <th class="px-4 py-2">อัพโหลดรูปภาพ</th>
                            <th class="px-4 py-2">จำนวนที่สามารถเข้าพัก</th>
                            <th class="px-4 py-2">จำนวนเตียง</th>
                            <th class="px-4 py-2">จำนวนห้องน้ำ</th>
                            <th class="px-4 py-2">ราคาค้างคืน</th>
                            <th class="px-4 py-2">ราคาชั่วคราว</th>
                            <th class="px-4 py-2">สถานะห้อง</th>
                            <th class="px-4 py-2">รายละเอียดห้องพัก</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach($rooms as $room)
                        <tr class="">
                            <td class=" px-4 py-2 text-center" id="เลขห้อง">{{ $loop->index + 1 }}</td>
                            <td class=" px-4 py-2 text-center" id="รูป"><img src="{{ asset('images/' . $room->room_image) }}" alt="" width="100" height="100"></td>
                            <td class=" px-4 py-2 text-center" id="จำนวนที่สามารถเข้าพัก">{{ $room->room_occupancy }}</td>
                            <td class=" px-4 py-2 text-center" id="จำนวนห้องน้ำ">{{ $room->room_bed }}</td>
                            <td class=" px-4 py-2 text-center" id="จำนวนห้องน้ำ">{{ $room->room_bathroom }}</td>
                            <td class=" px-4 py-2 text-center" id="ราคาค้างคืน">{{ $room->price_night }}</td>
                            <td class=" px-4 py-2 text-center" id="ราคาชั่วคราว">{{ $room->price_temporary }}</td>
                            <td class=" px-4 py-2 text-center">
                                @if($room->room_status == 'พร้อมให้บริการ')
                                <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                    <span class="w-2 h-2 me-1 bg-green-300 rounded-full mr-1"></span>
                                    {{ $room->room_status }}
                                </span>
                                @else
                                <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                    <span class="w-2 h-2 me-1 bg-red-300 rounded-full mr-1"></span>
                                    {{ $room->room_status }}
                                </span>
                                @endif
                            <td class=" px-4 py-2 text-center" id="รายละเอียดห้องพัก">{{$room->room_description}}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </section>

    </div>

    <script>
        document.getElementById("submit").addEventListener("click", function() {
            window.location.href = "Room.html"; // เปลี่ยนเป็น URL ที่ต้องการไป
        });

        document.getElementById("cancel").addEventListener("click", function() {
            window.location.href = "Room.html"; // เปลี่ยนเป็น URL ที่ต้องการไป
        });
    </script>
</body>

</html>