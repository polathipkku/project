<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.28/dist/fancybox.css">
    <link href="src/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="/images/Logo_2.jpg" type="image/png">
    <link rel="stylesheet" href="/css/hero.css">

    <title>Thunthree Gallery</title>

</head>

<body class="bg-gray-100">
    <!-- Header Section -->
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

    <div id="backdrop"
        class="fixed inset-0 bg-black opacity-0 z-40 pointer-events-none transition-opacity duration-300">
    </div>

    <div id="sidebar" class=" sidebar-hidden fixed top-0 right-0 w-1/4 h-full bg-white p-5 shadow-lg z-50">
        <h2 class="text-2xl font-bold mb-5">จองห้องพัก</h2>
        <form>
            <div class="mb-4">
                <label for="checkin" class="block text-gray-700">เช็คอิน</label>
                <input type="date" id="checkin" name="checkin" class="w-full border p-2 rounded">
            </div>
            <div class="mb-4">
                <label for="checkout" class="block text-gray-700">เช็คเอาท์</label>
                <input type="date" id="checkout" name="checkout" class="w-full border p-2 rounded">
            </div>
            <div class="mb-4">
                <label for="rooms" class="block text-gray-700">จำนวนห้อง</label>
                <input type="number" id="rooms" name="rooms" class="w-full border p-2 rounded" min="1">
            </div>
            <div class="mb-4">
                <label for="guests" class="block text-gray-700">จำนวนผู้เข้าพัก</label>
                <input type="number" id="guests" name="guests" class="w-full border p-2 rounded" min="1">
            </div>
            <button type="submit"
                class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-700">เช็คห้องว่าง</button>
        </form>
    </div>

    <!-- Gallery Content -->
    <main class="container mx-auto mt-10">
        <div class="text-center mb-10 mr-12">
            <h1 class="text-4xl font-bold">แกลเลอรี่</h1>
            <p class="text-xl mt-4">ภาพบรรยากาศที่สวยงามของเรา</p>
        </div>
        <div class="gallery-grid grid-cols-2">
            <div class="gallery-item">
                <a href="/images/tb1.png" data-fancybox="gallery">
                    <img src="/images/tb1.png" alt="Gallery Image 1">
                    <div class="overlay">
                        <div class="overlay-content">
                            <h3>Gallery Image 1</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="gallery-item">
                <a href="/images/S__13500422.jpg" data-fancybox="gallery">
                    <img src="/images/S__13500422.jpg" alt="Gallery Image 2">
                    <div class="overlay">
                        <div class="overlay-content">
                            <h3>Gallery Image 2</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="gallery-item">
                <a href="/images/S__13500424.jpg" data-fancybox="gallery">
                    <img src="/images/S__13500424.jpg" alt="Gallery Image 3">
                    <div class="overlay">
                        <div class="overlay-content">
                            <h3>Gallery Image 3</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="gallery-item">
                <a href="/images/S__13500425.jpg" data-fancybox="gallery">
                    <img src="/images/S__13500425.jpg" alt="Gallery Image 3">
                    <div class="overlay">
                        <div class="overlay-content">
                            <h3>Gallery Image 4</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="gallery-item">
                <a href="/images/S__13500426.jpg" data-fancybox="gallery">
                    <img src="/images/S__13500426.jpg" alt="Gallery Image 3">
                    <div class="overlay">
                        <div class="overlay-content">
                            <h3>Gallery Image 5</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="gallery-item">
                <a href="/images/S__13500433.jpg" data-fancybox="gallery">
                    <img src="/images/S__13500433.jpg" alt="Gallery Image 3">
                    <div class="overlay">
                        <div class="overlay-content">
                            <h3>Gallery Image 6</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="gallery-item">
                <a href="/images/S__13500435.jpg" data-fancybox="gallery">
                    <img src="/images/S__13500435.jpg" alt="Gallery Image 3">
                    <div class="overlay">
                        <div class="overlay-content">
                            <h3>Gallery Image 7</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="gallery-item">
                <a href="/images/i-3.png" data-fancybox="gallery">
                    <img src="/images/i-3.png" alt="Gallery Image 3">
                    <div class="overlay">
                        <div class="overlay-content">
                            <h3>Gallery Image 8</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="gallery-item">
                <a href="/images/i-6.jpeg" data-fancybox="gallery">
                    <img src="/images/i-6.jpeg" alt="Gallery Image 3">
                    <div class="overlay">
                        <div class="overlay-content">
                            <h3>Gallery Image 9</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="gallery-item">
                <a href="/images/TT11.png" data-fancybox="gallery">
                    <img src="/images/TT11.png" alt="Gallery Image 3">
                    <div class="overlay">
                        <div class="overlay-content">
                            <h3>Gallery Image 10</h3>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </main>

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

    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.28/dist/fancybox.umd.js"></script>
    <script src="/js/hero.js"></script>
    <script>
        document.addEventListener('scroll', function() {
            var header = document.querySelector('header');
            var mail = document.getElementById('mail');
            var scrollPosition = window.scrollY;

            if (scrollPosition > 100) { // เลื่อนลงเท่าไหร่ถึงจะปิด
                header.style.top = mail.offsetHeight + 'px'; // ปรับ header เลื่อนขึ้นปิด mail
            } else {
                header.style.top = '20px'; // ปรับ header 
            }
        });
    </script>
</body>

</html>