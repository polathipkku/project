<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จองห้องพัก</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                รายชื่อสินค้า
            </h2>
        </x-slot>
        <div class="container mx-auto max-w-lg">
            <h1 class="text-3xl font-bold text-center mt-10">จองห้องพัก</h1>

            <!-- แบบฟอร์มจอง -->
            <form action="/" method="post" class="mt-8">
                <div class="grid grid-cols-1 gap-4">

                    <!-- ส่วนของชื่อ -->
                    <div class="flex flex-col">
                        <label for="name" class="text-sm font-medium">ชื่อผู้จอง</label>
                        <input type="text" id="name" name="name" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full" required>
                    </div>

                    <!-- ส่วนของเบอร์โทรศัพท์ และ จำนวนผู้เข้าพัก -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col">
                            <label for="phone" class="text-sm font-medium">เบอร์โทรศัพท์</label>
                            <input type="tel" id="phone" name="phone" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full" required>
                        </div>
                        <div class="flex flex-col">
                            <label for="number_of_guests" class="text-sm font-medium">จำนวนผู้เข้าพัก</label>
                            <input type="number" id="number_of_guests" name="number_of_guests" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full" required>
                        </div>
                    </div>

                    <!-- ส่วนของวันที่เข้าพัก และ วันที่ออกพัก -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col">
                            <label for="arrival_date" class="text-sm font-medium">วันที่เข้าพัก</label>
                            <input type="date" id="arrival_date" name="arrival_date" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full" required>
                        </div>
                        <div class="flex flex-col">
                            <label for="departure_date" class="text-sm font-medium">วันที่ออก</label>
                            <input type="date" id="departure_date" name="departure_date" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <!-- ส่วนของประเภทห้องพัก -->
                        <div class="flex flex-col">
                            <label for="room_type" class="text-sm font-medium">ห้องพักที่</label>
                            <select id="room_type" name="room_type" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full" required>
                                @foreach($rooms as $room)
                                <option value="{{ $room->room_name }}">{{ $room->room_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- ส่วนของประเภทห้องพัก -->
                        <div class="flex flex-col">
                            <label for="room_type" class="text-sm font-medium">ประเภทห้องพัก</label>
                            <select id="room_type" name="room_type" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full" required>
                                <option value="standard">ห้องพักค้างคืน</option>
                                <option value="deluxe">ห้องพักชั่วคราว</option>
                            </select>
                        </div>
                    </div>

                    <!-- ส่วนของโปรโมชั่น -->
                    <div class="flex flex-col">
                        <label for="promo_code" class="text-sm font-medium">รหัสโปรโมชั่น</label>
                        <input type="text" id="promo_code" name="promo_code" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full">
                    </div>
                    <!-- ส่วนของปุ่มยืนยัน -->
                    <div class="flex flex-col">
                        <button type="submit" class="bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">ยืนยันการจอง</button>
                    </div>
                </div>
            </form>

        </div>
    </x-app-layout>

</body>

</html>