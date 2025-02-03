<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Create Promotion</title>
</head>

<body>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>
    <div style="display: flex; background-color: #F5F3FF;">
        <!-- Sidebar -->
        @include('components.admin_sidebar')

        <section class="ml-10 bg-white" style="width:1100px; padding-left: 2.5%; padding-right: 2.5%;">
            <div class="max-w-screen-xl mx-auto py-10">
                <div class="px-2 p-2 flex justify-between items-center">
                    <h1 class="text-4xl mb-10 max-xl:px-4">สร้างโปรโมชั่น</h1>
                </div>

                <form method="POST" action="{{ route('promotions.store') }}" id="promotionForm">
                    @csrf

                    <div class="mb-6">
                        <label for="campaign_name"
                            class="block mb-2 text-sm font-medium text-gray-900">ชื่อโปรโมชั่น</label>
                        <input type="text" id="campaign_name" name="campaign_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            required />
                    </div>

                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="start_date"
                                class="block mb-2 text-sm font-medium text-gray-900">วันที่เริ่มโปรโมชั่น</label>
                            <input type="date" id="start_date" name="start_date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                required />
                        </div>
                        <div>
                            <label for="end_date"
                                class="block mb-2 text-sm font-medium text-gray-900">วันที่สิ้นสุดโปรโมชั่น</label>
                            <input type="date" id="end_date" name="end_date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                required />
                        </div>
                    </div>
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div class="mb-6">
                            <label for="type"
                                class="block mb-2 text-sm font-medium text-gray-900">ประเภทการลดราคา</label>
                            <select id="type" name="type"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                required>
                                <option value="" disabled selected>เลือกประเภท</option>
                                <option value="fix">Fix (จำนวนเงิน)</option>
                                <option value="percentage">Percentage (%)</option>
                            </select>
                        </div>

                        <div class="mb-6">
                            <label for="discount_value"
                                class="block mb-2 text-sm font-medium text-gray-900">ส่วนลด</label>
                            <div class="flex">
                                <input type="number" id="discount_value" name="discount_value"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    required />
                                <span id="discount_label" class="text-gray-600 ml-2 self-center"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="max_usage_per_code"
                            class="block mb-2 text-sm font-medium text-gray-900">การใช้ต่อรหัสโปรโมชันสูงสุด</label>
                        <input type="number" id="max_usage_per_code" name="max_usage_per_code"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            required />
                    </div>

                    <!-- เพิ่มฟิลด์สำหรับจำนวนคืนขั้นต่ำ -->
                    <div class="mb-6">
                        <label for="minimum_nights"
                            class="block mb-2 text-sm font-medium text-gray-900">จำนวนคืนขั้นต่ำ</label>
                        <input type="number" id="minimum_nights" name="minimum_nights"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                    </div>

                    <!-- เพิ่มฟิลด์สำหรับจำนวนเงินขั้นต่ำในการจอง -->
                    <div class="mb-6">
                        <label for="minimum_booking_amount"
                            class="block mb-2 text-sm font-medium text-gray-900">จำนวนเงินขั้นต่ำในการจอง</label>
                        <input type="number" id="minimum_booking_amount" name="minimum_booking_amount"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                    </div>
                    <div class="mb-6">
                        <label for="promotion_status"
                            class="block mb-2 text-sm font-medium text-gray-900">สถานะการใช้งาน</label>
                        <select id="promotion_status" name="promotion_status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            <option value="1">เปิดใช้งาน</option>
                            <option value="0">ปิดใช้งาน</option>
                        </select>
                    </div>


                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">สร้างโปรโมชั่น</button>

                    <!-- ปุ่มยกเลิก -->
                    <a href="{{ route('promotions') }}"
                        class="inline-block mt-4 text-center text-blue-600 hover:text-blue-800">
                        <button type="button"
                            class="text-white bg-gray-400 hover:bg-gray-500 rounded-lg text-sm px-5 py-2.5">ยกเลิก</button>
                    </a>
                </form>

            </div>
        </section>
    </div>
    <!-- Toast notification -->
    @if (session('success'))
    <script>
        window.onload = function() {
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                close: true,
                gravity: "top", // top or bottom
                position: 'center', // left, center or right
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
            }).showToast();
        };
    </script>
    @endif
    <script>
        const typeSelect = document.getElementById('type');
        const discountLabel = document.getElementById('discount_label');

        typeSelect.addEventListener('change', function() {
            if (this.value === 'fix') {
                discountLabel.textContent = ' บาท';
            } else if (this.value === 'percentage') {
                discountLabel.textContent = ' %';
            }
        });
    </script>

    <!-- Include Toastify -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>

</html>