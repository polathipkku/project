<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/hero.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <title>Tunthree - employee Management</title>

    <script>
        function showToast(toastId) {
            var toast = document.getElementById(toastId);
            toast.classList.add('show');
            setTimeout(function() {
                toast.classList.remove('show');
            }, 3000); // แสดง toast นาน 3 วินาที (3000 มิลลิวินาที)
        }
    </script>
</head>

<body>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>

    <div style="display: flex; background-color: #F5F3FF;">

        <!-- Sidebar -->
        @include('components.admin_sidebar')


        <!-- Promotion Management Table -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">

            <div class="container mx-auto px-6 py-8">
                <div class="flex justify-between items-center mb-6">
                    {{-- <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none lg:hidden">
                            <i class="fas fa-bars"></i>
                        </button> --}}
                    <h3 class="text-3xl font-medium text-gray-700">จัดการค่าใช้จ่าย</h3>
                </div>

                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                            <form action="#" method="GET" class="w-full md:w-auto mb-4 md:mb-0">
                                @csrf
                                <div class="relative">
                                    <input type="text" name="search" placeholder="ค้นหาค่าใช้จ่าย"
                                        class="w-full md:w-80 pl-10 pr-4 py-2 rounded-lg border focus:border-blue-300 focus:outline-none focus:shadow-outline">
                                    <div class="absolute top-0 left-0 inline-flex items-center p-2">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                </div>
                            </form>
                            <button onclick="openModal()"
                                class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                                <i class="fas fa-plus mr-2"></i>เพิ่มค่าใช้จ่าย
                            </button>
                        </div>

                        <!-- Promotion Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full border border-gray-200">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-center">ชื่อ</th>
                                        <th class="py-3 px-6 text-center">ราคา (บาท)</th>
                                        <th class="py-3 px-6 text-center">วันที่</th>
                                        <th class="py-3 px-6 text-center">ดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm text-gray-600">
                                    @foreach ($expenses as $expense)
                                    <tr class="border-t">
                                        <td class="py-3 px-6 text-center">{{ $expense->type }}</td>
                                        <td class="py-3 px-6 text-center">
                                            {{ number_format($expense->expenses_price, 2) }}
                                        </td>
                                        <td class="py-3 px-6 text-center">{{ \Carbon\Carbon::parse($expense->expenses_date)->format('d/m/y') }}</td>

                                        <td class="py-3 px-6 text-center">
                                            <button
                                                onclick="openEditModal({{ $expense->id }}, '{{ $expense->expenses_name }}', {{ $expense->expenses_price }}, '{{ $expense->expenses_date }}')"
                                                class="hover:text-blue-500 hover:underline mr-3">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <form action="{{ route('expenses.destroy', $expense->id) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirmDelete(event)">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="hover:text-red-500 hover:underline">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div id="expense-modal"
                class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg w-96 shadow-lg">
                    <h3 class="text-xl font-medium mb-4">เพิ่มค่าใช้จ่าย</h3>

                    <form action="{{ route('expenses.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700">ประเภทค่าใช้จ่าย</label>
                            <select id="expenseType" name="type" required class="w-full px-4 py-2 border rounded-lg">
                                <option value="">เลือกประเภท</option>
                                <option value="ค่าน้ำ">ค่าน้ำ</option>
                                <option value="ค่าไฟ">ค่าไฟ</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">ราคา (บาท)</label>
                            <input type="number" name="expenses_price" required class="w-full px-4 py-2 border rounded-lg">
                        </div>

                        <div class="mb-4 relative">
                            <label class="block text-gray-700">วันที่</label>
                            <input type="text" name="expenses_date" required class="datepicker w-full px-4 py-2 border rounded-lg pr-10">
                            <i class="fas fa-calendar absolute right-3 top-1/2 transform -translate-y-1/2 mt-3 text-gray-500"></i>
                        </div>

                        <div class="mb-4" id="expenseNameContainer">
                            <label class="block text-gray-700">ชื่อค่าใช้จ่าย</label>
                            <input type="text" name="expenses_name" required class="w-full px-4 py-2 border rounded-lg">
                        </div>

                        <div class="flex justify-between">
                            <button type="button" onclick="closeModal()" class="bg-gray-400 text-white px-4 py-2 rounded-lg">
                                ยกเลิก
                            </button>
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg">
                                บันทึก
                            </button>
                        </div>
                    </form>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const expenseTypeSelect = document.getElementById('expenseType');
                            const expenseNameContainer = document.getElementById('expenseNameContainer');
                            const expenseNameInput = document.querySelector('[name="expenses_name"]');

                            // ฟังก์ชันสำหรับอัปเดตการแสดงผลของชื่อค่าใช้จ่าย
                            function toggleExpenseName() {
                                const selectedType = expenseTypeSelect.value;

                                // เงื่อนไขที่ใช้เมื่อประเภทค่าใช้จ่ายเป็น "ค่าซ่อม" หรือ "ค่าซื้อเปลี่ยน"
                                if (selectedType === 'ค่าซ่อม' || selectedType === 'ค่าซื้อเปลี่ยน'|| selectedType === 'ของใช้') {
                                    expenseNameContainer.style.display = 'block'; // แสดงชื่อค่าใช้จ่าย
                                    expenseNameInput.removeAttribute('disabled'); // เปิดฟิลด์ให้กรอก
                                } else {
                                    expenseNameContainer.style.display = 'none'; // ซ่อนชื่อค่าใช้จ่าย
                                    expenseNameInput.setAttribute('disabled', true); // ปิดฟิลด์ไม่ให้กรอก
                                    expenseNameInput.value = ''; // เคลียร์ค่าของฟิลด์
                                }
                            }

                            // เรียกฟังก์ชันเมื่อหน้าโหลดและเมื่อมีการเลือกประเภท
                            toggleExpenseName();
                            expenseTypeSelect.addEventListener('change', toggleExpenseName);
                        });
                    </script>

                </div>
            </div>


            <!-- Edit Expense Modal -->
            <div id="edit-expense-modal"
                class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg w-96 shadow-lg">
                    <h3 class="text-xl font-medium mb-4">แก้ไขค่าใช้จ่าย</h3>

                    <form id="edit-expense-form" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit-expense-id" name="expense_id">

                        <div class="mb-4">
                            <label class="block text-gray-700">ชื่อค่าใช้จ่าย</label>
                            <input type="text" id="edit-expense-name" name="expenses_name" required
                                class="w-full px-4 py-2 border rounded-lg">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">ราคา (บาท)</label>
                            <input type="number" id="edit-expense-price" name="expenses_price" required
                                class="w-full px-4 py-2 border rounded-lg">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700">วันที่</label>
                            <input type="text" id="edit-expense-date" name="expenses_date" required
                                class="datepicker w-full px-4 py-2 border rounded-lg">
                            <i class="fas fa-calendar absolute right-3 top-1/2 transform -translate-y-1/2 mt-3 text-gray-500"></i>

                        </div>

                        <div class="flex justify-between">
                            <button type="button" onclick="closeEditModal()"
                                class="bg-gray-400 text-white px-4 py-2 rounded-lg">
                                ยกเลิก
                            </button>
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg">
                                บันทึก
                            </button>
                        </div>
                    </form>
                </div>
            </div>




            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/th.js"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // กำหนด flatpickr สำหรับฟอร์มเพิ่ม
                    flatpickr(".datepicker", {
                        dateFormat: "Y-m-d", // ส่งค่าวันที่ไปฐานข้อมูล (YYYY-MM-DD)
                        altInput: true,
                        altFormat: "d-m-Y", // แสดงผลเป็น "17-02-2025"
                        locale: "th",
                        allowInput: false
                    });

                    // กำหนด flatpickr สำหรับฟอร์มแก้ไข
                    let editDatePicker = flatpickr("#edit-expense-date", {
                        dateFormat: "Y-m-d", // ส่งค่าวันที่ไปฐานข้อมูล
                        altInput: true,
                        altFormat: "d/m/Y", // แสดงผลเป็น "17-02-2025"
                        locale: "th",
                        allowInput: false
                    });

                    // ฟังก์ชันเปิด Modal เพิ่มค่าใช้จ่าย
                    window.openModal = function() {
                        document.getElementById("expense-modal").classList.remove("hidden");
                    };

                    window.closeModal = function() {
                        document.getElementById("expense-modal").classList.add("hidden");
                    };

                    // ฟังก์ชันเปิด Modal แก้ไขค่าใช้จ่าย
                    window.openEditModal = function(id, name, price, date) {
                        document.getElementById("edit-expense-id").value = id;
                        document.getElementById("edit-expense-name").value = name;
                        document.getElementById("edit-expense-price").value = price;

                        // อัปเดตค่า flatpickr
                        editDatePicker.setDate(date, true);

                        document.getElementById("edit-expense-form").action = `/expenses/${id}`;
                        document.getElementById("edit-expense-modal").classList.remove("hidden");
                    };

                    window.closeEditModal = function() {
                        document.getElementById("edit-expense-modal").classList.add("hidden");
                    };

                    window.confirmDelete = function(event) {
                        if (!confirm("คุณแน่ใจหรือไม่ว่าต้องการลบค่าใช้จ่ายนี้?")) {
                            event.preventDefault();
                        }
                    };
                });
            </script>


        </main>
    </div>

    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
        @csrf
    </form>



</body>

</html>