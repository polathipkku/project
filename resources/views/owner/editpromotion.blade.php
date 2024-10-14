<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Edit Promotion</title>
</head>

<body>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>
    <div style="display: flex; background-color: #F5F3FF;">
        <!-- Sidebar -->
        <section class="sticky bg-white rounded-2xl p-2" id="nav-content" style="height: 100vh; width: 180px; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; margin-left: 2%; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">
            <div class="w-full lg:w-auto flex-grow lg:flex lg:flex-col bg-white lg:bg-transparent text-black">

                <!-- Logo -->
                <div style="display: grid; place-items: center; margin-bottom: 30px;">
                    <img src="/images/Logo.jpg" alt="Logo" style="width: 80px; height: auto; margin-bottom: -10px;">
                    <div class="text-black text-lg ">Tunthree</div>
                </div>

                <!-- Menu Items -->
                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:text-blue-700 hover:text-sm" href="#" id="Dashboard">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-layer-group mr-1"></i>
                        Dashboard
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:text-blue-700 hover:text-sm" href="#" id="Users">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-user mr-2"></i>Users
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="Employee.html" id="Employee">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-users mr-1"></i>Employee
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="{{ route('room') }}" id="Room">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-door-open mr-1"></i>Room
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="#" id="Stock">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-house-circle-check mr-1"></i>Stock
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-blue-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="{{ route('promotions') }}" id="Promotion">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-rectangle-ad mr-1"></i>Promotion
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="#" id="Review">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-regular fa-envelope mr-1"></i>Review
                    </div>
                </a>

                <!-- Logout -->
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-6 transition duration-300 ease-in-out hover:bg-transparent hover:text-red-500 hover:text-sm" style="position: absolute; bottom: 10px;" id="Logout">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-right-from-bracket mr-1"></i>Logout
                    </div>
                </a>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                    @csrf
                </form>
            </div>
        </section>

        <section class="ml-10 bg-white" style="width:1100px; padding-left: 2.5%; padding-right: 2.5%;">
            <div class="max-w-screen-xl mx-auto py-10">
                <div class="px-2 p-2 flex justify-between items-center">
                    <h1 class="text-4xl mb-10 max-xl:px-4">แก้ไขโปรโมชั่น</h1>
                </div>

                <form method="POST" action="{{ route('promotions.update', $promotion->id) }}" id="promotionForm">
                    @csrf
                    @method('PUT') <!-- ใช้ PUT method สำหรับการอัปเดต -->

                    <div class="mb-6">
                        <label for="campaign_name" class="block mb-2 text-sm font-medium text-gray-900">ชื่อโปรโมชั่น</label>
                        <input type="text" id="campaign_name" name="campaign_name"
                            value="{{ old('campaign_name', $promotion->campaign_name) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required />
                    </div>

                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900">วันที่เริ่มโปรโมชั่น</label>
                            <input type="date" id="start_date" name="start_date"
                                value="{{ old('start_date', $promotion->start_date ? $promotion->start_date->format('Y-m-d') : '') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required />
                        </div>
                        <div>
                            <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900">วันที่สิ้นสุดโปรโมชั่น</label>
                            <input type="date" id="end_date" name="end_date"
                                value="{{ old('end_date', $promotion->end_date ? $promotion->end_date->format('Y-m-d') : '') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required />
                        </div>
                    </div>

                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div class="mb-6">
                            <label for="type" class="block mb-2 text-sm font-medium text-gray-900">ประเภทการลดราคา</label>
                            <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                                <option value="" disabled {{ old('type', $promotion->type) === null ? 'selected' : '' }}>เลือกประเภท</option>
                                <option value="fix" {{ old('type', $promotion->type) === 'fix' ? 'selected' : '' }}>Fix (จำนวนเงิน)</option>
                                <option value="percentage" {{ old('type', $promotion->type) === 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                            </select>
                        </div>

                        <div class="mb-6">
                            <label for="discount_value" class="block mb-2 text-sm font-medium text-gray-900">ส่วนลด</label>
                            <div class="flex">
                                <input type="number" id="discount_value" name="discount_value"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    value="{{ old('discount_value', $promotion->discount_value) }}" required />
                                <span id="discount_label" class="text-gray-600 ml-2 self-center"></span>
                            </div>
                        </div>
                    </div>


                    <div class="mb-6">
                        <label for="max_usage_per_code" class="block mb-2 text-sm font-medium text-gray-900">การใช้ต่อรหัสโปรโมชันสูงสุด</label>
                        <input type="number" id="max_usage_per_code" name="max_usage_per_code"
                            value="{{ old('max_usage_per_code', $promotion->max_usage_per_code) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required />
                    </div>

                    <!-- ส่วนของฟิลด์จำนวนคืนขั้นต่ำ -->
                    <div class="mb-6">
                        <label for="minimum_nights" class="block mb-2 text-sm font-medium text-gray-900">จำนวนคืนขั้นต่ำ</label>
                        <input type="number" id="minimum_nights" name="minimum_nights"
                            value="{{ old('minimum_nights', $promotion->minimum_nights) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                    </div>

                    <!-- ส่วนของฟิลด์จำนวนเงินขั้นต่ำในการจอง -->
                    <div class="mb-6">
                        <label for="minimum_booking_amount" class="block mb-2 text-sm font-medium text-gray-900">จำนวนเงินขั้นต่ำในการจอง</label>
                        <input type="number" id="minimum_booking_amount" name="minimum_booking_amount"
                            value="{{ old('minimum_booking_amount', $promotion->minimum_booking_amount) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                    </div>

                    <div class="mb-6">
                        <label for="promotion_status" class="block mb-2 text-sm font-medium text-gray-900">สถานะการใช้งาน</label>
                        <select id="promotion_status" name="promotion_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                            <option value="1" {{ old('promotion_status', $promotion->promotion_status) == '1' ? 'selected' : '' }}>เปิดใช้งาน</option>
                            <option value="0" {{ old('promotion_status', $promotion->promotion_status) == '0' ? 'selected' : '' }}>ปิดใช้งาน</option>
                        </select>
                    </div>

                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">อัปเดตโปรโมชั่น</button>

                    <!-- ปุ่มยกเลิก -->
                    <a href="{{ route('promotions') }}" class="inline-block mt-4 text-center text-blue-600 hover:text-blue-800">
                        <button type="button" class="text-white bg-gray-400 hover:bg-gray-500 rounded-lg text-sm px-5 py-2.5">ยกเลิก</button>
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