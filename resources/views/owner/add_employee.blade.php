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

    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>
    <div style="display: flex; background-color: #F5F3FF;">

        @include('components.admin_sidebar')

        <section class="ml-10 bg-white" id="room-add" style="width:1100px; padding-left: 2.5%; padding-right: 2.5%;">
            <div class="max-w-screen-xl mx-auto py-10 ">
                <div class="px-2 p-2  flex justify-between items-center">
                    <h1 class="text-4xl mb-10 max-xl:px-4">เพิ่มพนักงาน</h1>
                    <button class="relative pr-12 mb-4 group">
                    </button>
                </div>

                <form method="POST" action="{{ route('owner.create') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid gap-6 mb-6 md:grid-cols-3">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ชื่อพนักงาน</label>
                            <input type="text" id="name" name="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required />
                        </div>

                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">อีเมลพนักงาน</label>
                            <input type="email" id="email" name="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required />
                        </div>

                        <div>
                            <label for="tel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">เบอร์โทรพนักงาน</label>
                            <input type="text" id="tel" name="tel"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required />
                        </div>
                    </div>

                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">รหัสผ่านพนักงาน</label>
                            <input type="password" id="password" name="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required autocomplete="new-password" />
                        </div>

                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ยืนยันรหัสผ่านพนักงาน</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required autocomplete="new-password" />
                        </div>
                    </div>


                    <div class="grid gap-6 mb-6 md:grid-cols-3">
                        <div>
                            <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">วันที่เริ่มทำงาน</label>
                            <div class="relative">
                                <input type="text" id="start_date" name="start_date"
                                    class="datepicker block w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="เลือกวันที่เริ่มทำงาน" required />
                                <svg class="absolute left-3 top-3 w-5 h-5 text-gray-500 pointer-events-none" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3M16 7V3M3 10h18M5 20h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">วันเกิดพนักงาน</label>
                            <div class="relative">
                                <input type="text" id="birthday" name="birthday"
                                    class="datepicker block w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="เลือกวันเกิด" required />
                                <svg class="absolute left-3 top-3 w-5 h-5 text-gray-500 pointer-events-none" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3M16 7V3M3 10h18M5 20h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <label for="payment_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">วันที่จ่ายเงินเดือน</label>
                            <div class="relative">
                                <input type="text" id="payment_date" name="payment_date"
                                    class="datepicker block w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="เลือกวันที่จ่ายเงินเดือน" required />
                                <svg class="absolute left-3 top-3 w-5 h-5 text-gray-500 pointer-events-none" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3M16 7V3M3 10h18M5 20h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-6 mb-6 md:grid-cols-3">
                        <div>
                            <label for="salary" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">เงินเดือน</label>
                            <input type="number" step="0.01" id="salary" name="salary"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required />
                        </div>
                        <div>
                            <label for="work_shift" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">กะเวลาทำงาน</label>
                            <select id="work_shift" name="work_shift"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required>
                                <option value="กลางวัน">กลางวัน</option>
                                <option value="กลางคืน">กลางคืน</option>
                            </select>
                        </div>
                        <div>
                            <label for="position" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ตำแหน่ง</label>
                            <select id="position" name="position"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required>
                                <option value="พนักงานทำความสะอาด">พนักงานทำความสะอาด</option>
                                <option value="พนักงานซักผ้า">พนักงานซักผ้า</option>
                                <option value="พนักงานต้อนรับ">พนักงานต้อนรับ</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div class="w-full">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">อัพโหลดรูปภาพพนักงาน</label>
                            <div id="drop-area"
                                class="flex flex-col items-center justify-center w-full h-32 p-4 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 dark:border-gray-600 hover:border-blue-500 relative overflow-hidden">
                                <input type="file" id="image" name="image" class="hidden" accept="image/*">

                                <!-- Default UI -->
                                <div id="upload-icon" class="flex flex-col items-center justify-center gap-2">
                                    <i class="fa-solid fa-upload text-gray-500 text-4xl"></i>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        ลากและวางไฟล์ที่นี่ หรือคลิกเพื่อเลือก
                                    </p>
                                </div>

                                <!-- Preview Image -->
                                <div id="preview-container" class="w-full h-full hidden">
                                    <img id="preview-image" class="w-full h-full object-cover rounded-lg">
                                    <button id="change-image"
                                        class="absolute bottom-2 right-2 px-3 py-1 text-xs font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                                        เปลี่ยนรูป
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ที่อยู่พนักงาน</label>
                            <textarea id="address" name="address"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 h-32 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="ใส่รายละเอียดที่อยู่" required></textarea>
                        </div>
                    </div>
                    {{-- เพิ่มฟิลด์ userType --}}
                    <input type="hidden" name="userType" value="1">

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">สร้างพนักงาน</button>

                    <!-- ปุ่มยกเลิก -->
                    <a href="{{ route('employee') }}"
                        class="inline-block mt-4 text-center text-blue-600 hover:text-blue-800">
                        <button type="button"
                            class="text-white bg-gray-400 hover:bg-gray-500 rounded-lg text-sm px-5 py-2.5">ยกเลิก</button>
                    </a>
                </form>

            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr(".datepicker", {
                dateFormat: "d/m/Y",
                clickOpens: true, // ให้เปิดปฏิทินเท่านั้น
                allowInput: false, // ห้ามพิมพ์
                disableMobile: true // ปิด datepicker บนมือถือ
            });

            // กำหนดค่า maxDate สำหรับวันเกิด (ต้องมีอายุ 18+)
            flatpickr("#birthday", {
                dateFormat: "d/m/Y",
                maxDate: new Date().fp_incr(-18 * 365), // นับย้อนหลัง 18 ปี
            });
        });
    </script>
    {{-- -----------------uploadpic----------------- --}}
    <script>
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('image');
        const uploadIcon = document.getElementById('upload-icon');
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview-image');
        const changeImageButton = document.getElementById('change-image');

        dropArea.addEventListener('click', () => fileInput.click());

        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                previewImage.src = URL.createObjectURL(file);
                uploadIcon.classList.add('hidden');
                previewContainer.classList.remove('hidden');
            }
        });

        dropArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropArea.classList.add('border-blue-500');
        });

        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('border-blue-500');
        });

        dropArea.addEventListener('drop', (event) => {
            event.preventDefault();
            dropArea.classList.remove('border-blue-500');
            const file = event.dataTransfer.files[0];
            if (file) {
                fileInput.files = event.dataTransfer.files;
                previewImage.src = URL.createObjectURL(file);
                uploadIcon.classList.add('hidden');
                previewContainer.classList.remove('hidden');
            }
        });

        changeImageButton.addEventListener('click', (event) => {
            event.stopPropagation();
            fileInput.click();
        });
    </script>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</body>

</html>