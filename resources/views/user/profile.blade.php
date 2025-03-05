<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.28/dist/fancybox.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/th.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/flowbite@1.3.3/dist/flowbite.js"></script>
    <link rel="shortcut icon" href="/images/Logo_2.jpg" type="image/png">
    <link rel="stylesheet" href="/css/hero.css">
    <link href="src/output.css" rel="stylesheet">
    <title>Thunthree</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <style>
        body {
            font-family: 'Prompt', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <!-- Navbar with Gradient -->
        <nav class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <!-- Logo -->
                            <a href="/" class="text-xl font-bold text-white flex items-center">
                                <i class="fa-solid fa-user-gear mr-2"></i>
                                <span>ระบบจัดการ</span>
                            </a>
                        </div>
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            <a href="#" class="text-gray-200 hover:text-white hover:border-white inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium transition duration-150">
                                <i class="fa-solid fa-home mr-2"></i>หน้าหลัก
                            </a>
                            <a href="{{ route('profile.edit', auth()->user()->id) }}" class="text-white inline-flex items-center px-1 pt-1 border-b-2 border-white text-sm font-medium">
                                <i class="fa-solid fa-user mr-2"></i>โปรไฟล์
                            </a>
                        </div>
                    </div>
                    <!-- User Dropdown and Mobile Menu -->
                    <div class="flex items-center">
                        <div class="hidden md:flex items-center">
                            <div class="relative ml-3">
                                <div>
                                    <button type="button" class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-600 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="sr-only">เปิดเมนูผู้ใช้</span>
                                        <div class="h-8 w-8 rounded-full bg-white text-indigo-600 flex items-center justify-center">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-100 hover:text-white hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                                <span class="sr-only">เปิดเมนูหลัก</span>
                                <i class="fa-solid fa-bars"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Header with Breadcrumbs -->
        <div class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <div class="flex items-center space-x-2 text-sm">
                    <a href="#" class="text-gray-500 hover:text-blue-600">
                        <i class="fa-solid fa-home"></i>
                    </a>
                    <span class="text-gray-500">
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </span>
                    <span class="text-blue-600 font-medium">แก้ไขโปรไฟล์</span>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="py-10 flex-grow">
            <main>
                <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                    <!-- Card with light shadow and rounded corners -->
                    <div class="bg-white overflow-hidden shadow-md rounded-xl">
                        <div class="p-6">
                            <!-- Page Title -->
                            <div class="mb-8 border-b border-gray-200 pb-5">
                                <h1 class="text-2xl font-bold text-gray-900 flex items-center">
                                    <i class="fa-solid fa-user-pen text-blue-600 mr-3"></i>
                                    <span>แก้ไขข้อมูลส่วนตัว</span>
                                </h1>
                            </div>

                            <!-- Success Message -->
                            @if (session('success'))
                            <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-md flex items-start" role="alert">
                                <div class="flex-shrink-0 mt-0.5">
                                    <i class="fa-solid fa-circle-check text-green-500"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium">{{ session('success') }}</p>
                                </div>
                                <button class="ml-auto">
                                    <i class="fa-solid fa-xmark text-green-500 hover:text-green-700"></i>
                                </button>
                            </div>
                            @endif

                            <!-- Form -->
                            <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                                @csrf
                                @method('PUT')

                                <div class="flex flex-col md:flex-row gap-10">
                                    <!-- Left Column - Photo -->
                                    <div class="w-full md:w-1/3">
                                        <div class="flex flex-col items-center space-y-4">
                                            <div class="relative group">
                                                <!-- แสดงรูปโปรไฟล์จากฐานข้อมูล หรือใช้รูป default -->
                                                <img id="profilePreview"
                                                    src="{{ $user->image ? asset('storage/' . $user->image) : asset('default-avatar.png') }}"
                                                    alt="User Image"
                                                    class="h-56 w-56 rounded-full object-cover border-4 border-gray-200 group-hover:border-blue-300 transition duration-300 shadow-md">

                                                <!-- ปุ่มอัปโหลด -->
                                                <label for="image" class="absolute bottom-3 right-3 bg-blue-600 text-white p-3 rounded-full cursor-pointer hover:bg-blue-700 transition shadow-lg transform group-hover:scale-110">
                                                    <i class="fa-solid fa-camera"></i>
                                                    <input id="image" name="image" type="file" class="hidden" accept="image/*">
                                                </label>
                                            </div>

                                            <!-- คำอธิบาย -->
                                            <div class="text-sm text-gray-500 text-center">
                                                <p>คลิกที่ไอคอนกล้องเพื่ออัปโหลดรูปโปรไฟล์ใหม่</p>
                                                <p class="text-xs mt-1 text-gray-400">รองรับไฟล์ภาพ .jpg, .png, .gif ไม่เกิน 2MB</p>
                                            </div>

                                            <!-- แจ้งเตือน error -->
                                            @error('image')
                                            <span class="text-red-500 text-sm bg-red-50 px-3 py-1 rounded-full">
                                                <i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <script>
                                        document.getElementById('image').addEventListener('change', function(event) {
                                            const file = event.target.files[0];
                                            if (file) {
                                                const reader = new FileReader();
                                                reader.onload = function(e) {
                                                    document.getElementById('profilePreview').src = e.target.result;
                                                }
                                                reader.readAsDataURL(file);
                                            }
                                        });
                                    </script>


                                    <!-- Right Column - Info -->
                                    <div class="w-full md:w-2/3 space-y-5">
                                        <!-- Name -->
                                        <div class="group">
                                            <label for="name" class="block text-sm font-medium text-gray-700 group-focus-within:text-blue-600 transition">
                                                <i class="fa-solid fa-user-tag mr-2"></i>
                                                ชื่อ-นามสกุล
                                            </label>
                                            <div class="mt-1 relative rounded-md shadow-sm">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <i class="fa-solid fa-signature text-gray-400 group-focus-within:text-blue-500 transition"></i>
                                                </div>
                                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                                    class="pl-10 focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                            </div>
                                            @error('name')
                                            <span class="text-red-500 text-sm">
                                                <i class="fa-solid fa-circle-exclamation mr-1"></i>
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="group">
                                            <label for="email" class="block text-sm font-medium text-gray-700 group-focus-within:text-blue-600 transition">
                                                <i class="fa-solid fa-envelope mr-2"></i>
                                                อีเมล
                                            </label>
                                            <div class="mt-1 relative rounded-md shadow-sm">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <i class="fa-solid fa-at text-gray-400 group-focus-within:text-blue-500 transition"></i>
                                                </div>
                                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                                    class="pl-10 focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                            </div>
                                            @error('email')
                                            <span class="text-red-500 text-sm">
                                                <i class="fa-solid fa-circle-exclamation mr-1"></i>
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>

                                        <!-- Tel -->
                                        <div class="group">
                                            <label for="tel" class="block text-sm font-medium text-gray-700 group-focus-within:text-blue-600 transition">
                                                <i class="fa-solid fa-phone mr-2"></i>
                                                เบอร์โทรศัพท์
                                            </label>
                                            <div class="mt-1 relative rounded-md shadow-sm">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <i class="fa-solid fa-mobile-screen text-gray-400 group-focus-within:text-blue-500 transition"></i>
                                                </div>
                                                <input type="text" name="tel" id="tel" value="{{ old('tel', $user->tel) }}"
                                                    class="pl-10 focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                            </div>
                                            @error('tel')
                                            <span class="text-red-500 text-sm">
                                                <i class="fa-solid fa-circle-exclamation mr-1"></i>
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>

                                        <!-- Birthday -->
                                        <div class="group">
                                            <label for="birthday" class="block text-sm font-medium text-gray-700 group-focus-within:text-blue-600 transition">
                                                <i class="fa-solid fa-cake-candles mr-2"></i>
                                                วันเกิด
                                            </label>
                                            <div class="mt-1 relative rounded-md shadow-sm">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <i class="fa-solid fa-calendar-day text-gray-400 group-focus-within:text-blue-500 transition"></i>
                                                </div>
                                                <input type="date" name="birthday" id="birthday" value="{{ old('birthday', $user->birthday) }}"
                                                    class="pl-10 focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                            </div>
                                            @error('birthday')
                                            <span class="text-red-500 text-sm">
                                                <i class="fa-solid fa-circle-exclamation mr-1"></i>
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>

                                        <!-- Address -->
                                        <div class="group">
                                            <label for="address" class="block text-sm font-medium text-gray-700 group-focus-within:text-blue-600 transition">
                                                <i class="fa-solid fa-location-dot mr-2"></i>
                                                ที่อยู่
                                            </label>
                                            <div class="mt-1 relative rounded-md shadow-sm">
                                                <div class="absolute top-3 left-3 flex items-start pointer-events-none">
                                                    <i class="fa-solid fa-house text-gray-400 group-focus-within:text-blue-500 transition"></i>
                                                </div>
                                                <textarea name="address" id="address" rows="3"
                                                    class="pl-10 focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('address', $user->address) }}</textarea>
                                            </div>
                                            @error('address')
                                            <span class="text-red-500 text-sm">
                                                <i class="fa-solid fa-circle-exclamation mr-1"></i>
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Buttons with Animation -->
                                <div class="flex justify-end space-x-4 pt-4 border-t border-gray-100">
                                    <a href="{{ route('home') }}" class="inline-flex justify-center items-center py-2.5 px-6 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition transform hover:-translate-y-0.5">
                                        <i class="fa-solid fa-xmark mr-2"></i>
                                        ยกเลิก
                                    </a>

                                    <button type="submit" class="inline-flex justify-center items-center py-2.5 px-6 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition transform hover:-translate-y-0.5">
                                        <i class="fa-solid fa-floppy-disk mr-2"></i>
                                        บันทึกข้อมูล
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-sm text-gray-500">
                        © 2025 ระบบจัดการข้อมูลส่วนบุคคล
                    </div>
                    <div class="flex space-x-6 mt-3 md:mt-0">
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fa-solid fa-circle-question"></i>
                            <span class="ml-1">ช่วยเหลือ</span>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fa-solid fa-shield"></i>
                            <span class="ml-1">นโยบายความเป็นส่วนตัว</span>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- JavaScript - Show preview before uploading with animation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const photoInput = document.getElementById('photo');
            photoInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgElement = document.querySelector('.relative.group img');
                        if (imgElement) {
                            // Add animation class
                            imgElement.classList.add('animate-pulse');

                            // Update source
                            imgElement.src = e.target.result;

                            // Remove animation after a brief delay
                            setTimeout(() => {
                                imgElement.classList.remove('animate-pulse');
                            }, 1000);
                        } else {
                            // Create new img element if not exists
                            const div = document.querySelector('.relative.group div');
                            if (div) {
                                div.innerHTML = '';
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.className = 'h-56 w-56 rounded-full object-cover border-4 border-gray-200 group-hover:border-blue-300 transition duration-300 shadow-md animate-pulse';
                                img.alt = 'Profile Preview';
                                div.parentNode.replaceChild(img, div);

                                // Create the hover overlay
                                const overlay = document.createElement('div');
                                overlay.className = 'absolute inset-0 bg-blue-600 bg-opacity-0 group-hover:bg-opacity-20 rounded-full transition duration-300 flex items-center justify-center';

                                const icon = document.createElement('i');
                                icon.className = 'fa-solid fa-camera text-white text-3xl opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition duration-300';
                                overlay.appendChild(icon);

                                img.parentNode.appendChild(overlay);

                                // Remove animation after a brief delay
                                setTimeout(() => {
                                    img.classList.remove('animate-pulse');
                                }, 1000);
                            }
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Optional: Animate success message dismissal
            const successCloseBtn = document.querySelector('.bg-green-50 button');
            if (successCloseBtn) {
                successCloseBtn.addEventListener('click', function() {
                    const alert = this.closest('[role="alert"]');
                    alert.classList.add('opacity-0', 'transform', 'translate-y-1');
                    setTimeout(() => {
                        alert.remove();
                    }, 300);
                });
            }
        });
    </script>
</body>

</html>