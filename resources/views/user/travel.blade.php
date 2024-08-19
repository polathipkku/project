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
                <a href="welcome">Thunthree
                </a>
            </div>
            <div class="flex items-center space-x-4 text-gray-800 text-base">
                <a href="#" onclick="showLoginForm()" class="flex items-center space-x-1 hover:text-blue-400">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span>เข้าสู่ระบบ</span>
                </a>
                <a href="#" class="flex items-center space-x-1 hover:text-blue-400">
                    <i class="fa-solid fa-user"></i>
                    <span>สมัครสมาชิก</span>
                </a>
                <button id="booking-btn"
                    class="bg-blue-500 text-white px-8 py-4 rounded-lg border-2 border-blue-500 hover:bg-white hover:text-blue-500 hover:border-blue-500 transition-colors ">
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

    <main class="container mx-auto px-4 py-6">
        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4"> วัดวังคำ</h2>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex flex-col md:flex-row">
                    <img src="/images/tv-2.jpg" alt="Phuwiang National Park"
                        class="w-full md:w-1/3 rounded-lg mb-4 md:mb-0 md:mr-6">
                    <div>
                        <p class="text-gray-600 mb-4">วัดวังคำ
                            เป็นวัดที่มีความสำคัญในประวัติศาสตร์และวัฒนธรรมของพื้นที่ ตั้งอยู่ห่างจากรีสอร์ทประมาณ 25
                            นาที สถานที่นี้มีโครงสร้างที่งดงามและบรรยากาศที่สงบ เหมาะสำหรับการทำบุญและสักการะ</p>
                        <p class="text-gray-600">ระยะทาง: 22.5 กิโลเมตร</p>
                        <p class="text-gray-600">เวลาที่ใช้ในการเดินทาง: 25 นาที</p>
                        <a href="https://maps.app.goo.gl/HcvN4AH6GGJJFYrTA" target="_blank"
                            class="text-blue-500 hover:underline">google map</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4"> อ่างเลิงซิว</h2>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex flex-col md:flex-row">
                    <img src="/images/t-1.jpg" alt="พระธาตุยาคู"
                        class="w-full md:w-1/3 rounded-lg mb-4 md:mb-0 md:mr-6">
                    <div>
                        <p class="text-gray-600 mb-4">เป็นอ่างเก็บน้ำขนาดเล็ก ที่เป็นสวนสาธารณะ ผู้คนออกมาพบปะกัน
                            ชมความสวยงามของธรรมชาติ ห่างจากรีสอร์ทเพียงแค่ 2 นาที</p>
                        <p class="text-gray-600">ระยะทาง: 1.5 กิโลเมตร</p>
                        <p class="text-gray-600">เวลาที่ใช้ในการเดินทาง: 2 นาที</p>
                        <a href="https://maps.app.goo.gl/NmBF4skedXWrtmH66" target="_blank"
                            class="text-blue-500 hover:underline">google map</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4"> วนอุทยานภูแฝก</h2>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex flex-col md:flex-row">
                    <img src="/images/tv-3.jpg" alt="Wat Thung Setthi"
                        class="w-full md:w-1/3 rounded-lg mb-4 md:mb-0 md:mr-6">
                    <div>
                        <p class="text-gray-600 mb-4">วนอุทยานภูแฝก ตั้งอยู่ห่างจากรีสอร์ทประมาณ 32 นาที
                            เป็นพื้นที่ที่มีความงดงามทางธรรมชาติและเหมาะสำหรับการเดินป่าและการสัมผัสธรรมชาติ
                            สถานที่นี้มีจุดชมวิวที่สวยงามและเส้นทางเดินป่าที่ท้าทาย</p>
                        <p class="text-gray-600">ระยะทาง: 25.3 กิโลเมตร</p>
                        <p class="text-gray-600">เวลาที่ใช้ในการเดินทาง: 32 นาที</p>
                        <a href=" https://maps.app.goo.gl/W32eCqgHKtWXCem79" target="_blank"
                            class="text-blue-500 hover:underline">google map</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4"> หลวงปู่ศิลา</h2>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex flex-col md:flex-row">
                    <img src="/images/tv-4.jpg" alt="Wat Thung Setthi"
                        class="w-full md:w-1/3 rounded-lg mb-4 md:mb-0 md:mr-6">
                    <div>
                        <p class="text-gray-600 mb-4">นักท่องเที่ยวและผู้คนทั่วไทยต่างให้ความสนใจที่จะมาสักการะหลวงปู่ศิลา 
                            จากความดังและความเชื่อในพระพุทธศาสนาและความศักดิ์สิทธิ์ของท่าน
                             นี่เป็นสถานที่ที่ทุกคนที่มาเที่ยวกาฬสินธุ์ห้ามพลาด</p>
                        <p class="text-gray-600">ระยะทาง: 53.3 กิโลเมตร</p>
                        <p class="text-gray-600">เวลาที่ใช้ในการเดินทาง: 39 นาที</p>
                        <a href=" https://maps.app.goo.gl/6HAAfPSkKZ68Q7CJ6" target="_blank"
                            class="text-blue-500 hover:underline">google map</a>
                    </div>
                </div>
            </div>
        </section>
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

    <div id="loginForm" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50 hidden">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md relative">
            <div class="absolute top-0 right-0 mt-4 mr-4 z-10">
                <button onclick="hideLoginForm()" class="focus:outline-none">
                    <img src="images/reject.png" alt="Reject" class="w-6 h-6">
                </button>
            </div>
            <h2 class="text-3xl font-bold mb-6 text-center">Login</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <input id="email"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                        type="email" name="email" :value="old('email')" placeholder="Email" required
                        autofocus />
                </div>
                <div class="mb-4">
                    <input id="password"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                        type="password" name="password" placeholder="Password" required
                        autocomplete="current-password" />
                </div>
                <div class="flex items-center mb-6">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="h-4 w-4 text-blue-600 rounded focus:ring-blue-500 border-gray-300" />
                    <label for="remember_me" class="ml-2 text-sm text-gray-600">Remember me</label>
                    <a href="{{ route('password.request') }}"
                        class="ml-auto text-sm text-blue-600 hover:text-blue-800">Forgot password</a>
                </div>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Login</button>
                <div class="text-center mt-4">
                    <p class="text-sm text-gray-600">Don't have an account? <a href="#"
                            class="text-blue-600 hover:text-blue-800" onclick="showRegisterForm()">Register</a></p>
                </div>
            </form>
        </div>
    </div>

    <div id="registerForm"
        class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50 hidden">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md relative">
            <div class="absolute top-0 right-0 mt-4 mr-4 z-10">
                <button onclick="hideRegisterForm()" class="focus:outline-none">
                    <img src="images/reject.png" alt="Reject" class="w-6 h-6">
                </button>
            </div>
            <h2 class="text-3xl font-bold mb-2 text-center">Register</h2>
            <form class="space-y-6" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <input id="name" name="name" type="text" autocomplete="name" required
                        class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                        placeholder="Name">
                </div>

                <div class="mb-4">
                    <input id="email" name="email" type="email" autocomplete="email" required
                        class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                        :value="old('email')" placeholder="Email" autofocus>
                </div>

                <div class="mb-4">
                    <input id="password" name="password" type="password" autocomplete="new-password" required
                        class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                        placeholder="Password">
                </div>

                <div class="mb-4">
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        autocomplete="new-password" required
                        class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                        placeholder="Confirm Password">
                </div>

                <div class="mb-4">
                    <input id="tel" name="tel" type="text" autocomplete="tel" required
                        class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                        placeholder="Telephone">
                </div>

                <div class="mb-4">
                    <input id="start_date" name="start_date" type="date" required
                        class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <input id="birthday" name="birthday" type="date" required
                        class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <input id="address" name="address" type="text" required
                        class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                        placeholder="Address">
                </div>

                <div class="mb-4">
                    <input id="image" name="image" type="file" required
                        class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                </div>

                @if (config('jetstream.features.terms_and_privacy_policy'))
                    <!-- Terms and Privacy Policy checkbox -->
                    <div class="mb-4">
                        <input id="terms" name="terms" type="checkbox"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="terms" class="text-sm text-gray-900 ml-2">I agree to the <a
                                href="{{ route('terms.show') }}" class="underline">Terms of Service</a> and <a
                                href="{{ route('policy.show') }}" class="underline">Privacy Policy</a></label>
                    </div>
                @endif

                <!-- Register Button -->
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4">Register</button>


                <!-- Link to show login form -->
                <div class="text-center mt-2">
                    <p class="text-sm text-gray-600">Already have an account? <a href="#"
                            class="text-blue-600 hover:text-blue-800" onclick="showLoginForm()">Login</a></p>
                </div>
            </form>
        </div>
    </div>
    <script src="https://unpkg.com/flowbite@1.3.3/dist/flowbite.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.28/dist/fancybox.umd.js"></script>
    <!-- <script src="/js/heroJS.js"></script> -->
    <script src="/js/hero.js"></script>
    <script>
    </script>

</body>

</html>
