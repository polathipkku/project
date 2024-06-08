<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dist\output.css">
    <link rel="shortcut icon" href="images/TTbell.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet" />

    <title>Thunthree</title>

    <link rel="stylesheet" type="text/css" href="/css/bootstrap.css" />
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->

</head>

<div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
        <div class="header_top fixed top-0 left-0 w-full z-50 ">
            <div class="container-fluid ">
                <div class="contact_nav">
                    <a href="">
                        <i class="fa-solid fa-phone"></i>
                        <span>
                            Call : 0940028212
                        </span>
                    </a>
                    <a href="">
                        <i class="fa-solid fa-envelope"></i>
                        <span>
                            Email : polathip.b@kkumail.com
                        </span>
                    </a>
                    <a href="https://maps.app.goo.gl/DvK7VftrFYtfJbAS7">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>
                            Location
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <div class="w-full flex flex-wrap items-center justify-between mx-auto py-4 max-xl:p-4 shadow-md fixed top-10 left-0 w-full z-40 bg-white" style="padding: 5%;">
            <a href="{{route('home')}}" class="text-black text-4xl font-bold">Tunthree Resort</a>
            <div class="relative">
                <nav class="space-x-10 text-xl">

                    <a href="history.html" class="text-black hover:text-blue-400">ประวัติการจอง<i class="fa-solid fa-clock-rotate-left ml-2"></i></a>
                    <a href="about.html" class="text-black hover:text-blue-400">รีวิว<i class="fa-solid fa-star ml-2"></i></a>
                    <a href="contact.html" class="text-black hover:text-blue-400">ติดต่อเรา<i class="fa-solid fa-comments ml-2"></i></a>
                    <!-- User Menu Dropdown -->
                    <button id="profileButton" type="button" class="text-black hover:text-blue-400 focus:outline-none">
                        <i class="fa-solid fa-user"></i>
                        <span class="sr-only">User Menu</span>
                    </button>
                    <div id="profileDropdown" class="absolute hidden right-0 ml-2 mt-2 w-38 bg-white rounded-md shadow-lg">
                        <div class="py-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                        </div>
                    </div>
                </nav>
            </div>
    </header>
</div>
<div class="mx-auto pt-2 pb-2 ">
    <p class="text-gray-600 text-l max-xl:px-4 pt-8" style="margin-left: 7%;">
        <a href="{{route('home')}}" class="text-black hover:text-blue-400">Home</a>
        <i class="fa-solid fa-chevron-right ml-2 mr-2"></i>
        <a href="reserve.html" class="text-black hover:text-blue-400">จองห้อง</a>
        <i class="fa-solid fa-chevron-right ml-2 mr-2"></i>
        <a href="#" class="text-blue-600 hover:text-black">เลือกดูห้อง</a>
    </p>
</div>
<section>
    <div class="w-full h-24 flex items-center justify-center  px-4 " style="background-color: #04233B;">

        <div class="flex items-center mt-4">
            <div class="mr-4 ">
                <span class="font-semibold text-white">Check-in Date</span>
                <input type="date" id="checkin_date" name="checkin_date" class="ml-2 border border-gray-400 rounded-md px-2 py-1">
            </div>
        </div>

        <div class="flex items-center mt-4">
            <div class="mr-4 ">
                <span class="font-semibold text-white">Check-out Date</span>
                <input type="date" id="checkout_date" name="checkout_date" class="ml-2 border border-gray-400 rounded-md px-2 py-1">
            </div>
        </div>
        <div class="mt-4">
            <button id="search-button" type="button" class=" flex items-center justify-center text-white px-4 py-2 rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-600 " style="background-color: #0A97B0;" onclick="getAvailableRooms()">
                ค้นหา
            </button>
        </div>
    </div>
</section>

</div>

    <div class="max-w-screen-xl mx-auto py-10 ">
        <div class="px-2 p-2  flex justify-between items-center">
            <h1 class="text-4xl mb-10 max-xl:px-4">ห้อง</h1>
            <!-- <button class="relative pr-12 mb-4 group" onclick="window.location.href ='Room_add.html'">
                        <span
                            class="absolute hidden bg-gray-800 text-white px-2 py-1 rounded-md text-xs bottom-10 transition duration-300 ease-in-out opacity-0 group-hover:opacity-100">เพิ่มห้อง</span>
                        <i class="fa-solid fa-circle-plus text-4xl text-gray-500 group-hover:text-gray-900"></i>
                    </button> -->



        </div>
        <table class="w-full border-collapse ">
            <thead>
                <tr class="text-l bg-gray-300">
                    <th class=" px-4 py-2 text-center">หมายเลขห้อง</th>
                    <th class=" px-4 py-2 text-center">สถานะ</th>
                    <th class=" px-4 py-2 text-center">รายละเอียด</th>
                    <th class=" px-4 py-2 text-center" style="padding-right: 10%;"><span class="hidden">sdss</span>จองห้องพัก</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($rooms as $room)
                <tr class="">
                    <td class="px-4 py-2 text-center">{{ $room->room_name }}</td>
                    <td class="px-4 py-2 text-center">
                        @if($room->room_status === 'พร้อมให้บริการ')
                        @if($room->booking_status !== 'ทำการจอง' && $room->booking_status !== 'รอชำระเงิน' && $room->booking_status !== 'เช็คอินแล้ว')
                        <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                            <span class="w-2 h-2 me-1 bg-green-300 rounded-full mr-1"></span>
                            ว่าง
                        </span>
                        @else
                        <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                            <span class="w-2 h-2 me-1 bg-red-300 rounded-full mr-1"></span>
                            ไม่ว่าง
                        </span>
                        @endif
                        @else
                        <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                            <span class="w-2 h-2 me-1 bg-red-300 rounded-full mr-1"></span>
                            ไม่ว่าง
                        </span>
                        @endif
                    </td>

                    <td class="px-4 py-2 text-center">
                        <a href="" class="text-blue-500 hover:text-blue-700">Detail</a>
                    </td>
                    <td class="px-4 py-2" style="padding-right: 10%;">
                        <a href="/reserve/{{ $room->id }}" class="text-black hover:text-blue-500">
                            <i class="fa-solid fa-book-open"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


<!-- <script>
    function getAvailableRooms() {
        var checkinDate = document.getElementById("checkin_date").value;
        var checkoutDate = document.getElementById("checkout_date").value;

        fetch('/getAvailableRooms?checkin_date=' + checkinDate + '&checkout_date=' + checkoutDate)
            .then(response => response.json())
            .then(data => {
                displayAvailableRooms(data.available_rooms, checkinDate, checkoutDate);
            })
            .catch(error => console.error('Error:', error));
    }

    function displayAvailableRooms(rooms, checkinDate, checkoutDate) {
        if (rooms.length > 0) {
            var roomList = document.getElementById("roomListBody");
            roomList.innerHTML = "";
            rooms.forEach(function(room, index) {
                var row = document.createElement("tr");
                row.innerHTML = `
                    <td class="py-2 px-4 border-b text-center">${index + 1}</td>
                    <td class="py-2 px-4 border-b text-center">
                        <a href="/roomdetail" class="text-blue-500 hover:underline">Detail</a>
                    </td>
                    <td class="py-2 px-4 border-b text-center">
                        <span class="bg-green-500 text-white py-1 px-2 rounded-full">${room.room_status}</span>
                     </td>
                    <td class="py-2 px-4 border-b text-center">${checkinDate}</td>
                    <td class="py-2 px-4 border-b text-center">${checkoutDate}</td>
                     <td class="py-2 px-4 border-b text-center">
                        <a href="/reserve/${room.id}" class="text-blue-500 hover:underline">จองห้องพัก</a>
                    </td>
    `;
                roomList.appendChild(row);
            });


            // แสดงหน้าส่วนของห้องพักที่ว่าง
            showRoomList();
        } else {
            // หากไม่มีห้องพักที่ว่าง
            alert("ไม่พบห้องพักที่ว่างในช่วงเวลาที่ระบุ");
        }
    }

    function showRoomList() {
        var roomListSection = document.getElementById("roomListSection");
        roomListSection.style.display = "block";
    }

    var checkinDate = document.getElementById("checkin_date").value;
    var checkoutDate = document.getElementById("checkout_date").value;
</script> -->


</body>

</html>