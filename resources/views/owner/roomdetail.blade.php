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

<body class="bg-gray-50">
    <div class="flex">
        @include('components.admin_sidebar')

        <!-- Main Content -->
        <section class="flex-1 p-8">
            <div class="max-w-screen-xl mx-auto">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-800">รายละเอียดห้องพัก</h1>
                    <button onclick="window.location.href ='/room'" class="text-red-500 hover:text-gray-700 text-2xl transition duration-300">
                        <i class="fa-solid fa-times-circle"></i>
                    </button>
                </div>

                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">หมายเลขห้อง</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/12">รูปภาพ</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">จำนวนผู้เข้าพัก</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">เตียง</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">ห้องน้ำ</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">ราคาค้างคืน</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">ราคาชั่วคราว</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">สถานะ</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-3/12">รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($rooms as $room)
                                <tr class="hover:bg-gray-50 transition duration-300">
                                    <td class="px-6 py-4 text-sm text-gray-900 align-top">{{ $loop->index + 1 }}</td>
                                    <td class="px-6 py-4 align-top">
                                        <img src="{{ asset('images/' . $room->room_image) }}" alt="room image" class="w-16 h-16 rounded-lg object-cover shadow-sm">
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 align-top">{{ $room->room_occupancy }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 align-top">{{ $room->room_bed }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 align-top">{{ $room->room_bathroom }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-green-600 align-top">฿{{ number_format($room->price_night) }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-blue-600 align-top">฿{{ number_format($room->price_temporary) }}</td>
                                    <td class="px-6 py-4 text-sm align-top whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                            {{ $room->room_status == 'พร้อมให้บริการ' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $room->room_status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 align-top">{{ $room->room_description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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