<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/hero.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Tunthree - จัดการค่าเสียหายสินค้า</title>

    <script>
        function showToast(toastId) {
            var toast = document.getElementById(toastId);
            toast.classList.add('show');
            setTimeout(function() {
                toast.classList.remove('show');
            }, 3000);
        }

        function confirmDelete(event, url) {
            event.preventDefault();
            Swal.fire({
                title: 'ยืนยันการลบค่าเสียหาย?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: "<div class = 'bg-blue-500'", // สีแดงสด
                cancelButtonColor: "#ffffff", // สีขาว
                cancelButtonText: "<span style='color: black;'>ยกเลิก</span>", // เปลี่ยนตัวหนังสือเป็นสีดำ
                confirmButtonText: "ยืนยัน",
                reverseButtons: true // ปุ่มยืนยันไปอยู่ทางขวา
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    </script>
</head>

<body>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>

    <div style="display: flex; background-color: #F5F3FF;">
        @include('components.admin_sidebar')
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-3xl font-medium text-gray-700">จัดการค่าเสียหายสินค้า</h3>
                </div>
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                            <form action="#" method="GET" class="w-full md:w-auto mb-4 md:mb-0">
                                @csrf
                                <div class="relative">
                                    <input type="text" name="search" placeholder="ค้นหาสินค้า"
                                        class="w-full md:w-80 pl-10 pr-4 py-2 rounded-lg border focus:border-blue-300 focus:outline-none focus:shadow-outline">
                                    <div class="absolute top-1/2 left-3 transform -translate-y-1/2">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                </div>
                            </form>
                            <button onclick="window.location.href='{{ route('add_productroom') }}'"
                                class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                                <i class="fas fa-plus mr-2"></i>เพิ่มค่าเสียหายของสินค้า
                            </button>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full table-auto">
                                <thead>
                                    <tr class="bg-gradient-to-r from-blue-100 to-indigo-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left">ลำดับ</th>
                                        <th class="py-3 px-6 text-left">ชื่อสินค้า</th>
                                        <th class="py-3 px-6 text-left">ราคา (บาท)</th>
                                        <th class="py-3 px-6 text-center">จำนวนสินค้า</th>
                                        <th class="py-3 px-6 text-center">ดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm">
                                    @foreach ($productroom as $product)
                                        <tr
                                            class="border-b border-gray-200 hover:bg-gray-100 transition duration-300 ease-in-out">
                                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                                <span class="font-medium">{{ $loop->iteration }}</span>
                                            </td>
                                            <td class="py-3 px-6 text-left">
                                                <span>{{ $product->productroom_name }}</span>
                                            </td>
                                            <td class="py-3 px-6 text-left">
                                                <span
                                                    class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-sm">{{ number_format($product->productroom_price, 2) }}
                                                    ฿</span>
                                            </td>
                                            <td class="py-3 px-6 text-center">
                                                <span>{{ $product->product_qty }}</span>
                                            </td>
                                            <td class="py-3 px-6 text-center">
                                                <div class="flex items-center justify-center">
                                                    <button
                                                        onclick="openEditModal('{{ $product->id }}', '{{ $product->productroom_name }}', '{{ $product->productroom_price }}', '{{ $product->product_qty }}')"
                                                        class="text-yellow-500 hover:text-yellow-600 mr-3">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <a href="#"
                                                        onclick="confirmDelete(event, '{{ route('deleteProductRoom', $product->id) }}')"
                                                        class="delete-link">
                                                        <button class="text-red-500 hover:text-red-600" type="button">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="editModal" class="fixed inset-0 z-50 hidden bg-black/50 overflow-y-auto h-full w-full flex items-center justify-center">
        <div class="bg-white w-[95%] max-w-2xl mx-auto rounded-2xl shadow-2xl border border-gray-200 transform transition-all duration-300 ease-in-out">
            <div class="bg-blue-600 text-white px-6 py-4 rounded-t-2xl flex justify-between items-center">
                <h2 class="text-2xl font-bold">แก้ไขค่าเสียหาย</h2>
                <button onclick="closeModal()" class="text-white hover:text-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="editForm" method="POST" class="p-6">
                @csrf
                @method('POST')

                <input type="hidden" id="edit_id" name="id">

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- ชื่อสินค้า -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">ชื่อสินค้าที่เสียหาย</label>
                        <input type="text" id="edit_name" name="productroom_name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" 
                            required>
                    </div>

                    <!-- ราคาค่าปรับ -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">ราคาค่าปรับ</label>
                        <input type="text" id="edit_price" name="productroom_price"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" 
                            required>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- จำนวนสินค้า -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">จำนวนสินค้า</label>
                        <input type="number" id="edit_qty" name="product_qty" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all"
                            required min="1">
                    </div>

                    <!-- หมวดหมู่ค่าเสียหาย -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">หมวดหมู่ค่าเสียหาย</label>
                        <select id="edit_category" name="productroom_category" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" 
                            required>
                            <option value="เฟอร์นิเจอร์">เฟอร์นิเจอร์</option>
                            <option value="อุปกรณ์ไฟฟ้า">อุปกรณ์ไฟฟ้า</option>
                            <option value="ผ้า">ผ้า</option>
                            <option value="แก้ว">แก้ว</option>
                            <option value="อื่นๆ">อื่นๆ</option>
                        </select>
                    </div>
                </div>

                <!-- ประเภทการซ่อม -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">ประเภทการซ่อม</label>
                    <select id="edit_repair_type" name="repair_type" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all" 
                        required>
                        <option value="แจ้งซ่อม">แจ้งซ่อม</option>
                        <option value="ซื้อเปลี่ยน">ซื้อเปลี่ยน</option>
                    </select>
                </div>

                <!-- ปุ่ม -->
                <div class="flex justify-end space-x-4 mt-6">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                        ยกเลิก
                    </button>
                    <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        บันทึก
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, name, price, qty, category, repairType) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_price').value = price;
            document.getElementById('edit_qty').value = qty;
            document.getElementById('editForm').action = `/productroom/update/${id}`;

            // กำหนดค่า select สำหรับหมวดหมู่ค่าเสียหาย
            document.getElementById('edit_category').value = category;

            // กำหนดค่า select สำหรับประเภทการซ่อม
            document.getElementById('edit_repair_type').value = repairType;

            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>


</body>

</html>
