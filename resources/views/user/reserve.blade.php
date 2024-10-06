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

    <style>

    </style>
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


    <main class="bg-gray-200 ">
        <div class="max-w-screen-xl mx-auto pt-8 pb-16">
            <div class="bg-white max-w-5xl mx-auto">
                <div class="mx-auto h-16 mb-8" style="background-color: #042a48">
                    <div class="text-white text-2xl ml-2 pt-4">
                        จองห้อง
                    </div>
                </div>
                <div class="flex justify-center text-center space-x-1 ">
                    <button id="selfBookingBtn"
                        class="inline-block px-8 py-4 bg-blue-500 text-white rounded border-2 font-semibold border-blue-500 hover:bg-blue-500 hover:text-white hover:border-blue-500 transition-colors w-80">
                        จองให้ตัวเอง
                    </button>
                    <button id="otherBookingBtn"
                        class="inline-block px-8 py-4 bg-white text-blue-500 rounded font-semibold border-2 border-blue-500 hover:bg-blue-500 hover:text-white hover:border-blue-500 transition-colors w-80">
                        จองให้ผู้อื่น
                    </button>
                </div>
            </div>
            @if (Route::has('login'))
            @auth
            @else
            <div class="bg-white max-w-5xl mx-auto rounded-lg text-center py-4">
                <div class="border border-gray-500 w-4/5 mx-auto">
                    <!-- Section 1: Information and Login -->
                    <div class="flex justify-between items-center p-4">
                        <!-- Info Section -->
                        <div class="flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="flex flex-col">
                                <span
                                    class="text-blue-500 font-semibold text-lg">ดูเหมือนว่าคุณยังไม่ได้เป็นสมาชิก</span>
                                <span class="text-sm text-orange-500">สมัครเพื่อรับสิทธิพิเศษสำหรับสมาชิก</span>
                            </div>
                        </div>

                        <!-- Login Section -->
                        <div class="flex flex-col items-end">
                            <button onclick="showLoginForm()"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 w-40 rounded focus:outline-none focus:shadow-outline">
                                Login
                            </button>
                            <span class="text-sm text-gray-500 mt-1">เป็นสมาชิกกับเราแล้วหรือยัง?</span>
                        </div>
                    </div>

                    <!-- Section 2: Benefits -->
                    <div class="mb-2 mt-1 grid grid-cols-6 gap-x-2 ">
                        <div class="flex flex-col items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V9a4 4 0 10-8 0v4M4 9v4m0 4h16m-8 2a2 2 0 110-4 2 2 0 010 4z" />
                            </svg>
                            <span class="text-sm">ส่วนลดพิเศษ</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c1.5 0 3 .672 3 2v2h-6V9c0-1.328 1.5-2 3-2zm0-3a5 5 0 100 10 5 5 0 000-10zm0 15c1.657 0 3-1.343 3-3h-6c0 1.657 1.343 3 3 3zm4.218-8.215c1.468-.365 2.78-.859 2.78-1.785 0-.927-1.312-1.42-2.78-1.785m-8.436 0c-1.468.365-2.78.859-2.78 1.785 0 .927 1.312 1.42 2.78 1.785" />
                            </svg>
                            <span class="text-sm">ข้อเสนอพิเศษ</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v2a2 2 0 002 2h2a2 2 0 002-2v-2m0-3v-2a3 3 0 10-6 0v2m6-10h2a2 2 0 012 2v2m-2-4a2 2 0 012 2m-2 2h-2m-4 4v-4h-4m0 0a2 2 0 012-2m2 2v4" />
                            </svg>
                            <span class="text-sm">ของขวัญฟรี</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7m2-5a10 10 0 11-10 10 10 10 0 0110-10z" />
                            </svg>
                            <span class="text-sm">สะสมแต้ม</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ฟอร์ม Login (ซ่อนว้ในตอนแรก) -->
            <div id="loginForm"
                class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50 hidden">
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
                                    class="text-blue-600 hover:text-blue-800"
                                    onclick="showRegisterForm()">Register</a></p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ฟอร์มลงทะเบียน (Register Form) -->
            <div id="registerForm"
                class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50 hidden">
                <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm relative">
                    <div class="absolute top-0 right-0 mt-4 mr-4 z-10">
                        <button onclick="hideRegisterForm()" class="focus:outline-none">
                            <img src="images/reject.png" alt="Reject" class="w-6 h-6">
                        </button>
                    </div>
                    <h2 class="text-3xl font-bold mb-2 text-center">Register</h2>
                    <form class="space-y-6" action="{{ route('register') }}" method="POST"
                        enctype="multipart/form-data">
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
                            <input id="password" name="password" type="password" autocomplete="new-password"
                                required
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
                            <input id="birthday" name="birthday" type="date" required
                                class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                        </div>

                        <div class="mb-4">
                            <input id="address" name="address" type="text"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                                placeholder="Address">
                        </div>

                        <div class="mb-4">
                            <input id="image" name="image" type="file"
                                class="block w-full  px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                        </div>

                        @if (config('jetstream.features.terms_and_privacy_policy'))
                        <div class="mb-4">
                            <input id="terms" name="terms" type="checkbox"
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="terms" class="text-sm text-gray-900 ml-2">I agree to the <a
                                    href="{{ route('terms.show') }}" class="underline">Terms of
                                    Service</a> and <a href="{{ route('policy.show') }}"
                                    class="underline">Privacy Policy</a></label>
                        </div>
                        @endif

                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 w-full text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4">Register</button>

                        <div class="text-center mt-2">
                            <p class="text-sm text-gray-600">Already have an account? <a href="#"
                                    class="text-blue-600 hover:text-blue-800" onclick="showLoginForm()">Login</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
            @endauth
            @endif
            <form method="POST" id="selfBookingForm" action="{{ route('bookings.reserve') }}">
                @csrf
                <div class="max-w-5xl mx-auto ">
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 ">
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold mb-2">ข้อมูลผู้จอง</h3>
                            <div class="mb-4 flex space-x-4">
                                <div class="w-1/2">
                                    <label for="booking_name"
                                        class="block text-gray-700 text-sm font-bold mb-2">ชื่อผู้จอง:</label>
                                    <input type="text" name="booking_name" id="booking_name"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>

                                <div class="w-1/2">
                                    <label for="phone"
                                        class="block text-gray-700 text-sm font-bold mb-2">เบอร์โทรศัพท์:</label>
                                    <input type="text" name="phone" id="phone"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                            </div>

                            @if (!auth()->check())
                            <div class="mb-4">
                                <label for="email"
                                    class="block text-gray-700 text-sm font-bold mb-2">อีเมล:</label>
                                <input type="email" name="email" id="email"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                            </div>
                            @endif
                            <div class="mb-8 flex space-x-4 items-stretch ">
                                <div
                                    class="{{ $occupancy_child > 0 || $occupancy_baby > 0 ? ($occupancy_child > 0 && $occupancy_baby > 0 ? 'w-1/3' : 'w-1/2') : 'w-full' }} flex-grow h-full">
                                    <label for="number_of_guests" class="block text-gray-700 text-sm font-bold mb-2">
                                        จำนวนผู้เข้าพัก (ผู้ใหญ่):
                                    </label>
                                    <input type="number" name="number_of_guests" id="number_of_guests"
                                        value="{{ old('number_of_guests', $number_of_guests) }}"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-full"
                                        readonly>
                                </div>

                                @if ($occupancy_child > 0)
                                <div class="{{ $occupancy_baby > 0 ? 'w-1/3' : 'w-1/2' }} flex-grow h-full">
                                    <label for="occupancy_child"
                                        class="block text-gray-700 text-sm font-bold mb-2">
                                        จำนวนผู้เข้าพัก (เด็ก):
                                    </label>
                                    <input type="number" name="occupancy_child" id="occupancy_child"
                                        value="{{ old('occupancy_child', $occupancy_child) }}"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-full"
                                        readonly>
                                </div>
                                @endif

                                @if ($occupancy_baby > 0)
                                <div class="{{ $occupancy_child > 0 ? 'w-1/3' : 'w-1/2' }} flex-grow h-full">
                                    <label for="occupancy_baby"
                                        class="block text-gray-700 text-sm font-bold mb-2">
                                        จำนวนผู้เข้าพัก (เด็กเล็ก):
                                    </label>
                                    <input type="number" name="occupancy_baby" id="occupancy_baby"
                                        value="{{ old('occupancy_baby', $occupancy_baby) }}"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-full"
                                        readonly>
                                </div>
                                @endif
                            </div>

                            <div class="mb-4 flex space-x-4">
                                <div class="flex-1">
                                    <label for="number_of_rooms" class="block text-gray-700 text-sm font-bold mb-2">
                                        จำนวนห้องที่ต้องการ:
                                    </label>
                                    <input type="text" name="number_of_rooms" id="number_of_rooms"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        value="{{ $number_of_rooms }}" readonly>
                                </div>

                                @if ($extra_bed_count > 0)
                                <div class="flex-1">
                                    <label for="extra_bed_count"
                                        class="block text-gray-700 text-sm font-bold mb-2">
                                        จำนวนเตียงเสริม:
                                    </label>
                                    <input type="text" name="extra_bed_count" id="extra_bed_count"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        value="{{ $extra_bed_count }}" readonly>
                                    <input type="hidden" name="extra_bed_count_hidden"
                                        id="extra_bed_count_hidden" value="{{ $extra_bed_count }}">
                                </div>
                                @endif
                            </div>


                            <div class="mb-4 flex space-x-4">
                                <div class="flex-1">
                                    <label for="checkin_date"
                                        class="block text-gray-700 text-sm font-bold mb-2">วันที่เช็คอิน:</label>
                                    <input type="date" name="checkin_date" id="checkin_date"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        value="{{ $checkin_date }}" readonly>
                                </div>
                                <div class="flex-1">
                                    <label for="checkout_date"
                                        class="block text-gray-700 text-sm font-bold mb-2">วันที่เช็คเอาท์:</label>
                                    <input type="date" name="checkout_date" id="checkout_date"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        value="{{ $checkout_date }}" readonly>
                                </div>
                            </div>
                            @if (auth()->check())
                            <div class="mb-4">
                                <label for="promo_code"
                                    class="block text-gray-700 text-sm font-bold mb-2">รหัสโปรโมชั่น:</label>
                                <input type="text" name="promo_code" id="promo_code"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="กรอกรหัสโปรโมชั่น (ถ้ามี)">
                            </div>
                            @endif
                            <div class="flex items-center justify-between">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    บันทึกการจอง
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form id="otherBookingForm" action="{{ route('bookings.reserve') }}" method="post"
                enctype="multipart/form-data" style="display:none;">
                @csrf
                <div class="max-w-5xl mx-auto">
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <h2 class="text-lg font-bold mb-4">กรุณากรอกข้อมูลการจองสำหรับผู้อื่น</h2>
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold mb-2">ข้อมูลผู้จอง</h3>
                            <div class="mb-4 flex space-x-4">
                                <div class="flex-1">
                                    <label for="booking_name"
                                        class="block text-gray-700 text-sm font-bold mb-2">ชื่อผู้จอง:</label>
                                    <input type="text" name="booking_name" id="booking_name"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        required>
                                </div>
                                <div class="flex-1">
                                    <label for="phone"
                                        class="block text-gray-700 text-sm font-bold mb-2">เบอร์โทรศัพท์:</label>
                                    <input type="text" name="phone" id="phone"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        required>
                                </div>
                            </div>
                            <hr class="border-t-2 border-gray-300 my-4">
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold mb-2">ข้อมูลผู้ที่จองให้</h3>
                                <div class="mb-4 flex space-x-4">
                                    <div class="flex-1">
                                        <label for="bookingto_username"
                                            class="block text-gray-700 text-sm font-bold mb-2">ชื่อผู้เข้าพัก:</label>
                                        <input type="text" name="bookingto_username" id="bookingto_username"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>

                                    <div class="flex-1">
                                        <label for="bookingto_phone"
                                            class="block text-gray-700 text-sm font-bold mb-2">เบอร์โทรศัพท์ผู้เข้าพัก:</label>
                                        <input type="text" name="bookingto_phone" id="bookingto_phone"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                </div>

                                @if (!auth()->check())
                                <div class="mb-4">
                                    <label for="email"
                                        class="block text-gray-700 text-sm font-bold mb-2">อีเมล:</label>
                                    <input type="email" name="email" id="email"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        required>
                                </div>
                                @endif

                                <div class="mb-8 flex space-x-4 items-stretch ">
                                    <div
                                        class="{{ $occupancy_child > 0 || $occupancy_baby > 0 ? ($occupancy_child > 0 && $occupancy_baby > 0 ? 'w-1/3' : 'w-1/2') : 'w-full' }} flex-grow h-full">
                                        <label for="number_of_guests"
                                            class="block text-gray-700 text-sm font-bold mb-2">
                                            จำนวนผู้เข้าพัก (ผู้ใหญ่):
                                        </label>
                                        <input type="number" name="number_of_guests" id="number_of_guests"
                                            value="{{ old('number_of_guests', $number_of_guests) }}"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-full"
                                            readonly>
                                    </div>

                                    @if ($occupancy_child > 0)
                                    <div class="{{ $occupancy_baby > 0 ? 'w-1/3' : 'w-1/2' }} flex-grow h-full">
                                        <label for="occupancy_child"
                                            class="block text-gray-700 text-sm font-bold mb-2">
                                            จำนวนผู้เข้าพัก (เด็ก):
                                        </label>
                                        <input type="number" name="occupancy_child" id="occupancy_child"
                                            value="{{ old('occupancy_child', $occupancy_child) }}"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-full"
                                            readonly>
                                    </div>
                                    @endif

                                    @if ($occupancy_baby > 0)
                                    <div class="{{ $occupancy_child > 0 ? 'w-1/3' : 'w-1/2' }} flex-grow h-full">
                                        <label for="occupancy_baby"
                                            class="block text-gray-700 text-sm font-bold mb-2">
                                            จำนวนผู้เข้าพัก (เด็กเล็ก):
                                        </label>
                                        <input type="number" name="occupancy_baby" id="occupancy_baby"
                                            value="{{ old('occupancy_baby', $occupancy_baby) }}"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-full"
                                            readonly>
                                    </div>
                                    @endif
                                </div>

                                <div class="mb-4 flex space-x-4">
                                    <div class="flex-1">
                                        <label for="number_of_rooms"
                                            class="block text-gray-700 text-sm font-bold mb-2">
                                            จำนวนห้องที่ต้องการ:
                                        </label>
                                        <input type="text" name="number_of_rooms" id="number_of_rooms"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            value="{{ $number_of_rooms }}" readonly>
                                    </div>

                                    @if ($extra_bed_count > 0)
                                    <div class="flex-1">
                                        <label for="extra_bed_count"
                                            class="block text-gray-700 text-sm font-bold mb-2">
                                            จำนวนเตียงเสริม:
                                        </label>
                                        <input type="text" name="extra_bed_count" id="extra_bed_count"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            value="{{ $extra_bed_count }}" readonly>
                                        <input type="hidden" name="extra_bed_count_hidden"
                                            id="extra_bed_count_hidden" value="{{ $extra_bed_count }}">
                                    </div>
                                    @endif
                                </div>

                                <div class="mb-4 flex space-x-4">
                                    <div class="flex-1">
                                        <label for="checkin_date"
                                            class="block text-gray-700 text-sm font-bold mb-2">วันที่เช็คอิน:</label>
                                        <input type="date" name="checkin_date" id="checkin_date"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            value="{{ $checkin_date }}" readonly>
                                    </div>
                                    <div class="flex-1">
                                        <label for="checkout_date"
                                            class="block text-gray-700 text-sm font-bold mb-2">วันที่เช็คเอาท์:</label>
                                        <input type="date" name="checkout_date" id="checkout_date"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            value="{{ $checkout_date }}" readonly>
                                    </div>
                                </div>
                                @if (auth()->check())
                                <div class="mb-4">
                                    <label for="promo_code"
                                        class="block text-gray-700 text-sm font-bold mb-2">รหัสโปรโมชั่น:</label>
                                    <input type="text" name="promo_code" id="promo_code"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        placeholder="กรอกรหัสโปรโมชั่น (ถ้ามี)">
                                </div>
                                @endif
                            </div>
                            <div class="flex items-center justify-between">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">บันทึกการจอง</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @if (session('error'))
            <div id="toast-error"
                class="fixed bottom-5 right-5 bg-red-500 text-white py-2 px-4 rounded shadow-lg">
                {{ session('error') }}
            </div>
            @endif

            @if (session('success'))
            <div id="toast-success"
                class="fixed bottom-5 right-5 bg-green-500 text-white py-2 px-4 rounded shadow-lg">
                {{ session('success') }}
            </div>
            @endif

        </div>
    </main>
    <footer class="bg-gray-800 mt-10 text-white">
        <div class="container mx-auto p-5">
            <div class="flex flex-wrap">
                <!-- ข้อมูลการติดต่อ -->
                <div class="w-full md:w-1/3 mb-6">
                    <h4 class="text-xl font-bold">Tunthree Resort</h4>
                    <div class="mt-4">
                        <a href="https://maps.app.goo.gl/DvK7VftrFYtfJbAS7"
                            class="flex items-center mb-2">
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
                        <button type="submit"
                            class="bg-blue-500 p-2 w-full text-white">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="text-center">
                <small>
                    &copy; 2024 Tunthree Resort. All rights reserved.
                    <a href="#" class="hover:underline">Privacy Policy</a> •
                    <a href="#" class="hover:underline">Terms of Service</a>
                </small>
            </div>
        </div>
    </footer>

    <script src="/js/hero.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastError = document.getElementById('toast-error');
            const toastSuccess = document.getElementById('toast-success');
            if (toastError) {
                setTimeout(() => {
                    toastError.style.display = 'none';
                }, 3000); // Hide after 3 seconds
            }
            if (toastSuccess) {
                setTimeout(() => {
                    toastSuccess.style.display = 'none';
                }, 3000); // Hide after 3 seconds
            }
        });
    </script>

</body>

</html>