<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.28/dist/fancybox.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/flowbite@1.3.3/dist/flowbite.js"></script>
    <link rel="shortcut icon" href="/images/Logo_2.jpg" type="image/png">
    <link rel="stylesheet" href="/css/hero.css">
    <link href="src/output.css" rel="stylesheet">
    <script src="/js/hero.js"></script>

    <title>Thunthree</title>
</head>

<body class="bg-gray-100">
    <div class="flex items-center justify-between h-5  text-white" style="background-color: #042a48" id="mail">
        {{-- <a href="" class="mx-5"><i class="fa-solid fa-envelope"></i> supanat.d@kkumail.com</a>
        <a href="" class="mx-5"><i class="fa-solid fa-phone"></i>0961826631</a> --}}
    </div>

    <header class="bg-white shadow-lg pt-3">
        <div class="container mx-auto flex items-center justify-between h-24 px-5">
            <nav class="text-base">
                <div class="container mx-auto flex justify-center space-x-10 py-3">
                    <a href="gallery" class="hover:text-blue-400">แกลเลอรี่</a>
                    <a href="travel" class="hover:text-blue-400">สถานที่ท่องเที่ยว</a>
                    <a href="contact" class="hover:text-blue-400">ติดต่อ</a>
                </div>
            </nav>
            <div class="logo" id="logo">
                <a href="home" class="pl-24">Thunthree</a>
            </div>
            <div class="flex items-center space-x-4 text-gray-800 text-base">
                <nav class="flex space-x-10">
                    @guest
                    <!-- ปุ่ม Login -->
                    <a href="#" onclick="showLoginForm()" class="flex items-center space-x-1 hover:text-blue-400">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        <span>เข้าสู่ระบบ</span>
                    </a>

                    <!-- ปุ่ม Register -->
                    <a href="#" onclick="showRegisterForm()"
                        class="flex items-center space-x-1 hover:text-blue-400">
                        <i class="fa-solid fa-user"></i>
                        <span>สมัครสมาชิก</span>
                    </a>
                    @endguest
                    @auth
                    <a href="{{ route('reservation') }}" class="text-black hover:text-blue-400">ประวัติการจอง<i
                            class="fa-solid fa-clock-rotate-left ml-2"></i></a>
                    <a href="{{ route('review.index') }}" class="text-black hover:text-blue-400">รีวิว<i
                            class="fa-solid fa-star ml-2"></i></a>
                    <button id="profileButton" type="button" class="text-black hover:text-blue-400 focus:outline-none">
                        <i class="fa-solid fa-user"></i>
                        <span class="sr-only">User Menu</span>
                    </button>
                    <div id="profileDropdown"
                        class="absolute hidden right-40 ml-2 mt-1 w-38 bg-white rounded-md shadow-lg box-shadow-md">
                        <div class="py-1">
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Profile</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Settings</a>
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">
                                    Logout
                                </span>
                            </a>
                            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    @endauth
                    <!-- End  User Menu Dropdown -->
                </nav>
                <button id="booking-btn"
                    class="bg-blue-500 text-white px-8 py-4 rounded-lg border-2 border-blue-500 hover:bg-white hover:text-blue-500 hover:border-blue-500 transition-colors">
                    จองตอนนี้
                </button>
            </div>
        </div>
    </header>
    </div>
    <div class="mx-auto pt-4 pb-4 bg-gray-100">
        <p class="text-gray-600 text-lg max-xl:px-4 pt-8" style="margin-left: 7%;">
            <a href="{{ route('home') }}" class="text-black hover:text-blue-400">Home</a>
            <i class="fa-solid fa-chevron-right ml-2 mr-2"></i>
            <a href="{{ route('userbooking') }}" class="text-black hover:text-blue-400">จองห้อง</a>
            <i class="fa-solid fa-chevron-right ml-2 mr-2"></i>
            <a href="#" class="text-blue-600 hover:text-black">ประวิติการจอง</a>
        </p>
    </div>

    <div class=" mx-4 py-10 p-5 mb-10">
        <h1 class="text-5xl mb-10 max-xl:px-4">ประวัติการจอง</h1>
        <div class="grid justify-items-stretch  max-lg:grid-cols-1 max-xl:px-4">
            <div class="grid max-lg:grid-cols-1">

                @if (count($bookings) > 0)
                <div class="content">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-3 py-3 text-center" id="หมายเลขการจอง">
                                        หมายเลขการจอง</th>
                                    <th scope="col" class="px-3 py-3 text-center" id="ชื่อผู้จอง">ชื่อผู้จอง</th>
                                    <th scope="col" class="px-3 py-3 text-center" id="จำนวนผู้เข้าพัก">
                                        จำนวนผู้เข้าพัก</th>
                                    <th scope="col" class="px-3 py-3 text-center" id="ประเภทการจอง">
                                        วันที่เช็คอิน</th>
                                    <th scope="col" class="px-3 py-3 text-center" id="ประเภทการจอง">
                                        วันที่เช็คเอาท์</th>
                                    <th scope="col" class="px-3 py-3 text-center" id="ประเภทการจอง">
                                        ประเภทห้องพัก</th>
                                    <th scope="col" class="px-3 py-3 text-center" id="สถานะ">สถานะการจอง
                                    </th>
                                    <th scope="col" class="px-3 py-3 text-center" id="รายละเอียด">รายละเอียด
                                    </th>
                                    <th scope="col" class="px-3 py-3 text-center" id="รีวิว">รีวิว</th>
                                    <th scope="col" class="px-3 py-3 text-center" id="จองอีกครั้ง">จองอีกครั้ง
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $index => $booking)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 text-center">
                                    <th scope="row"
                                        class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="px-3 py-4 text-center">{{ $booking->booking_name }}</td>
                                    <td class="px-3 py-4 text-center">{{ $booking->occupancy_person }}</td>
                                    <td class="px-3 py-4 text-center">{{ $booking->checkin_date }}</td>
                                    <td class="px-3 py-4 text-center">{{ $booking->checkout_date }}</td>
                                    <td class="px-3 py-4 text-center">{{ $booking->room_type }}</td>
                                    <td class="px-3 py-4 text-center">
                                        @if ($booking->booking_status === 'ทำการจอง')
                                        <span
                                            class="mr-2 inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300 text-center">
                                            <span class="w-2 h-2 me-1 bg-yellow-300 rounded-full"></span>
                                            ทำการจอง </span>
                                        @elseif($booking->booking_status === 'รอเลือกห้อง')
                                        <span
                                            class="mr-2 inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300 text-center">
                                            <span class="w-2 h-2 me-1 bg-green-300 rounded-full"></span>
                                            รอเช็คอิน
                                        </span>
                                        @elseif($booking->booking_status === 'เช็คเอาท์')
                                        <span
                                            class="mr-2 inline-flex items-center bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300 text-center">
                                            <span class="w-2 h-2 me-1 bg-blue-300 rounded-full"></span>
                                            เช็คเอาท์ </span>
                                        @elseif($booking->booking_status === 'เช็คอินแล้ว')
                                        <span
                                            class="mr-2 inline-flex items-center bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300 text-center">
                                            <span class="w-2 h-2 me-1 bg-gray-300 rounded-full"></span>
                                            เช็คอินแล้ว </span>
                                        @elseif($booking->booking_status === 'รอชำระเงิน')
                                        <span
                                            class="mr-2 inline-flex items-center bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300 text-center">
                                            <span class="w-2 h-2 me-1 bg-gray-300 rounded-full"></span>
                                            รอชำระเงิน </span>
                                        @elseif($booking->booking_status === 'ยกเลิกการจอง')
                                        <span
                                            class="mr-2 inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300 text-center">
                                            <span class="w-2 h-2 me-1 bg-red-300 rounded-full"></span>
                                            {{ $booking->booking_status }}
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-4 flex justify-center items-center col-md-12">
                                        <a href="/reserve/resultreserve/1" class="ml-1 block ">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-4 h-4 text-gray-500 dark:text-gray-400 "
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M19 19l-4-4m0-7a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                                            </svg>
                                        </a>
                                    </td>
                                    <td class="px-4 py-2">
                                        @if ($booking->booking_status === 'เช็คเอาท์') <!-- ตรวจสอบสถานะการจอง -->
                                        @if ($booking->booking->review) <!-- ตรวจสอบว่าได้ทำการรีวิวแล้ว -->
                                        <button class="text-black hover:text-blue-500" onclick="openModal({{ $booking->booking->id }}, '{{ $booking->booking->review->rating }}', '{{ $booking->booking->review->comment }}')">
                                            ดู
                                        </button>
                                        @else
                                        <button class="text-black hover:text-blue-500" onclick="openModal({{ $booking->booking->id }})">
                                            รีวิว
                                        </button>
                                        @endif
                                        @else
                                        <span class="mr-2 inline-flex items-center bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            <span class="w-2 h-2 me-1 bg-gray-300 rounded-full"></span>
                                            ไม่สามารถรีวิวได้
                                        </span>
                                        @endif
                                    </td>



                                    <!-- Modal -->
                                    <div id="reviewModal"
                                        class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
                                        <div class="bg-white rounded-lg p-6 w-96">
                                            <h2 id="modalTitle" class="text-xl font-semibold mb-4">รีวิวการจอง
                                            </h2>

                                            <form id="reviewForm" action="{{ route('review.submit') }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="booking_id" id="bookingIdInput">

                                                <div class="mb-4">
                                                    <label class="block text-sm font-medium text-gray-700">ให้คะแนน</label>
                                                    <div class="flex space-x-1 mt-1">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" class="hidden" required onclick="setRating({{ $i }})">
                                                            <label for="star{{ $i }}" class="cursor-pointer text-gray-400 text-2xl">★</label>
                                                            @endfor
                                                    </div>
                                                </div>

                                                <div class="mt-4">
                                                    <label for="comment">ความคิดเห็น</label>
                                                    <textarea name="comment" id="comment" rows="4" class="w-full" required></textarea>
                                                </div>

                                                <div class="flex justify-end mt-4">
                                                    <button type="button"
                                                        class="bg-gray-500 text-white px-4 py-2 rounded mr-2"
                                                        onclick="closeModal()">ยกเลิก</button>
                                                    <button type="submit"
                                                        class="bg-blue-500 text-white px-4 py-2 rounded">ส่งรีวิว</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <script>
                                        function setRating(rating) {
                                            const stars = document.querySelectorAll('input[name="rating"]');
                                            const labels = document.querySelectorAll('label[for^="star"]');

                                            // เปลี่ยนสีดาวตามที่เลือก
                                            stars.forEach((star, index) => {
                                                if (index < rating) {
                                                    labels[index].classList.add('text-yellow-400'); // เปลี่ยนเป็นสีเหลือง
                                                } else {
                                                    labels[index].classList.remove('text-yellow-400'); // กลับเป็นสีเทา
                                                }
                                            });
                                        }
                                    </script>



                                    <td class="px-4 py-2">
                                        <a href="" class="text-black hover:text-blue-500">
                                            <i class="fa-solid fa-book-open"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p class="text-gray-600">ไม่พบการจอง</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
    <footer class="bg-gray-800 mt-10 text-white">
        <div class="container mx-auto p-5">
            <div class="flex flex-wrap">
                <!-- ข้อมูลการติดต่อ -->
                <div class="w-full md:w-1/3 mb-6">
                    <h4 class="text-xl font-bold">Tunthree Resort</h4>
                    <div class="mt-4">
                        <a href="https://maps.app.goo.gl/DvK7VftrFYtfJbAS7" class="flex items-center mb-2">
                            <i class="fa fa-map-marker mr-2"></i>
                            <span>Location</span>
                        </a>
                        <a href="tel:0940028212" class="flex items-center mb-2">
                            <i class="fa fa-phone mr-2"></i>
                            <span>Call 0940028212</span>
                        </a>
                        <a href="mailto:polathip.b@kkumail.com" class="flex items-center mb-2">
                            <i class="fa fa-envelope mr-2"></i>
                            <span>polathip.b@kkumail.com</span>
                        </a>
                    </div>

                </div>
                <!-- ลิงก์หลัก -->
                <div class="w-full md:w-1/3 mb-6">
                    <h4 class="text-xl font-bold">Quick Links</h4>
                    <div class="mt-4">
                        <a href="index.html" class="block mb-2">Home</a>
                        <a href="service.html" class="block mb-2">Services</a>
                        <a href="contact.html" class="block mb-2">Contact Us</a>
                    </div>
                </div>
                <!-- ฟอร์มสมัครสมาชิก -->
                <div class="w-full md:w-1/3 mb-6">
                    <h4 class="text-xl font-bold">Subscribe</h4>
                    <form action="#" class="mt-4">
                        <input type="email" placeholder="Enter email" class="p-2 w-full mb-2" />
                        <button type="submit" class="bg-blue-500 p-2 w-full text-white">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="text-center ">
                <small>
                    &copy; 2024 Tunthree Resort. All rights reserved.
                    <a href="#" class="hover:underline">Privacy Policy</a> •
                    <a href="#" class="hover:underline">Terms of Service</a>
                </small>
            </div>
        </div>
    </footer>
    <script>
        // เมื่อคลิกที่เมนูหรือพื้นหลังเว็บ
        document.addEventListener("click", function(event) {
            var profileButton = document.getElementById("profileButton");
            var profileDropdown = document.getElementById("profileDropdown");

            // ตรวจสอบว่าคลิกที่ปุ่มโปรไฟล์หรือไม่
            var isProfileButtonClicked = profileButton.contains(event.target);

            // ตรวจสอบว่าเมนู dropdown ถูกเปิดอยู่หรือไม่
            var isDropdownOpen = !profileDropdown.classList.contains("hidden");

            // ถ้าคลิกที่อื่นๆ และเมนู dropdown ไม่ถูกเปิดอยู่ให้ปิดเมนู dropdown
            if (!isProfileButtonClicked && isDropdownOpen) {
                profileDropdown.classList.add("hidden");
            }
        });

        // เมื่อคลิกที่ปุ่มโปรไฟล์
        document.getElementById("profileButton").addEventListener("click", function(event) {
            var profileDropdown = document.getElementById("profileDropdown");
            profileDropdown.classList.toggle("hidden"); // เปิดหรือปิดเมนู dropdown
            event.stopPropagation(); // ไม่ให้การคลิกที่ปุ่มแพร่กระจายไปยังโค้ดด้านบน
        });


        function setRating(rating) {
            const stars = document.querySelectorAll('input[name="rating"]');
            const labels = document.querySelectorAll('label[for^="star"]');

            // เปลี่ยนสีดาวตามที่เลือก
            stars.forEach((star, index) => {
                if (index < rating) {
                    labels[index].classList.add('text-yellow-400'); // เปลี่ยนเป็นสีเหลือง
                } else {
                    labels[index].classList.remove('text-yellow-400'); // กลับเป็นสีเทา
                }
            });
        }

        function openModal(bookingId, rating = null, comment = null) {
            document.getElementById('reviewModal').classList.remove('hidden');
            document.getElementById('bookingIdInput').value = bookingId;

            if (rating !== null && comment !== null) {
                // กรอกข้อมูลรีวิวที่มีอยู่
                document.getElementById('comment').value = comment;
                setRating(rating); // ตั้งค่าดาวตามที่รีวิว
                document.getElementById('modalTitle').innerText = 'ดูการรีวิว';

                // ซ่อนปุ่มส่งรีวิว
                document.querySelector('button[type="submit"]').style.display = 'none';
            } else {
                // รีเซ็ตข้อมูล
                document.getElementById('comment').value = '';
                setRating(0); // รีเซ็ตดาว
                document.getElementById('modalTitle').innerText = 'รีวิวการจอง';

                // แสดงปุ่มส่งรีวิว
                document.querySelector('button[type="submit"]').style.display = 'inline-block';
            }
        }

        function closeModal() {
            // ปิด Modal
            document.getElementById('reviewModal').classList.add('hidden');
        }
    </script>

</body>

</html>