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
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>

    <div style="display: flex; background-color: #F5F3FF;">

        @include('components.em_sidebar')


        <!-- --------------------------------------------------------------------------------------------------------------------- -->

        <section class="ml-10 bg-white" id="room-table" style="width:1100px; padding-left: 2.5%; padding-right: 2.5%;">
            <div class="max-w-screen-xl mx-auto py-10 ">
                <div class="px-2 p-2  flex justify-between items-center">
                    <h1 class="text-4xl mb-10 max-xl:px-4">รายละเอียดการจอง</h1>
                    <button class="relative pr-12 mb-4 group" onclick="window.location.href ='/checkout'">
                        <i class="fa-solid fa-circle-xmark text-4xl text-red-500 group-hover:text-red-900"></i>
                    </button>
                </div>
                <form>
                    @foreach($bookings as $booking)
                    <div class="grid grid-row-3 gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="ชื่อผู้จอง" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ชื่อผู้จอง</label>
                            <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 h-10 block 
                            w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 
                            dark:focus:border-blue-500" id="ชื่อผู้จอง">{{ $booking->booking_name}}</div>
                        </div>
                        <div>
                            <label for="เบอร์โทรศัพท์" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">เบอร์โทรศัพท์</label>
                            <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 h-10 block 
                            w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 
                            dark:focus:border-blue-500" id="เบอร์โทรศัพท์">{{ $booking->phone}}</div>
                        </div>
                        <div>
                            <label for="จำนวนผู้เข้าพัก" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">จำนวนผู้เข้าพัก</label>
                            <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 h-10 block
                             w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 
                             dark:focus:border-blue-500" id="จำนวนผู้เข้าพัก">{{ $booking->occupancy_person}}</div>
                        </div>
                        <div>
                            <label for="ประเภทการเข้าพัก" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ประเภทการเข้าพัก</label>
                            <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 h-10 block 
                            w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 
                            dark:focus:border-blue-500" id="ประเภทการเข้าพัก">{{ $booking->room_type}}</div>
                        </div>
                        <div>
                            <label for="Check-In" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Check-In</label>
                            <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 h-10 block 
                            w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 
                            dark:focus:border-blue-500" id="Check-In">{{ $booking->checkin_date}}</div>
                        </div>
                        <div>
                            <label for="Check-Out" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Check-Out</label>
                            <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 h-10 block 
                            w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 
                            dark:focus:border-blue-500" id="Check-Out">{{ $booking->checkout_date}}</div>
                        </div>
                        <!-- <div>
                            <label for="โค้ดโปรโมชั่น" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">โค้ดโปรโมชั่น</label>
                            <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 h-10 block 
                            w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 
                            dark:focus:border-blue-500" id="โค้ดโปรโมชั่น">Hoyya</div>
                        </div> -->
                        <!-- <div>
                            <label for="ส่วนลดที่ได้รับ" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ส่วนลดที่ได้รับ</label>
                            <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 h-10 block 
                            w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 
                            dark:focus:border-blue-500" id="ส่วนลดที่ได้รับ">50</div>
                        </div> -->
                        <div>
                            <label for="ราคาทั้งหมด" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ราคาทั้งหมด</label>
                            <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 h-10 block 
                            w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 
                          dark:focus:border-blue-500" id="ราคาทั้งหมด">
                                <?php
                                // เช็คเงื่อนไขของ room_type และแสดงราคาตามความเหมาะสม
                                if ($booking->room_type === 'ห้องพักค้างคืน') {
                                    echo $booking->room->price_night;
                                } else if ($booking->room_type === 'ห้องพักชั่วคราว') {
                                    echo $booking->room->price_temporary;
                                } else {
                                    echo 'ไม่พบข้อมูลราคา'; // สำหรับกรณีที่ไม่มี room_type ที่ตรงกับเงื่อนไขที่กำหนด
                                }
                                ?>
                            </div>
                        </div>

                        <!-- <div>
                            <label for="ราคารวมส่วนลด" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ราคารวมส่วนลด</label>
                            <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 h-10 block 
                            w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 
                            dark:focus:border-blue-500" id="ราคารวมส่วนลด">500</div>
                        </div> -->
                        <div>
                            <label for="เงินมัดจำ" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">เงินมัดจำ</label>
                            <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 h-10 block 
                            w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 
                            dark:focus:border-blue-500" id="เงินมัดจำ">{{ $booking->room->price_night}}</div>
                        </div>
                    </div>


                    <!-- <div class="flex justify-end">
                        <button id="ชำระเงิน" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 
                font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ชำระเงิน</button>
                        <button id="ยกเลิกการจอง" class="ml-4 text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 
                font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ยกเลิกการจอง</button>
                    </div> -->
                </form>
                @endforeach
            </div>
        </section>
    </div>


    <script>
        document.getElementById("submit").addEventListener("click", function() {
            window.location.href = "em_room.html"; // เปลี่ยนเป็น URL ที่ต้องการไป
        });

        document.getElementById("cancel").addEventListener("click", function() {
            window.location.href = "em_room.html"; // เปลี่ยนเป็น URL ที่ต้องการไป
        });
    </script>
</body>

</html>