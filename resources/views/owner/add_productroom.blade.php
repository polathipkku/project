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
                    <h1 class="text-4xl mb-10 max-xl:px-4">สร้างค่าเสียหาย</h1>
                </div>

                <form action="{{ route('addProductroom') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-6">
                        <label for="productroom_name" class="block mb-2 text-sm font-medium text-gray-900">ชื่อสินค้าที่เสียหาย</label>
                        <input type="text" id="productroom_name" name="productroom_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            required />
                        @error('productroom_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="productroom_price" class="block mb-2 text-sm font-medium text-gray-900">ราคาค่าปรับ</label>
                        <input type="text" id="productroom_price" name="productroom_price"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            required />
                        @error('productroom_price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="product_qty" class="block mb-2 text-sm font-medium text-gray-900">จำนวนสินค้า</label>
                        <input type="number" id="product_qty" name="product_qty"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            required min="1" />
                        @error('product_qty')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- เพิ่มหมวดหมู่ -->
                    <div class="mb-6">
                        <label for="productroom_category" class="block mb-2 text-sm font-medium text-gray-900">หมวดหมู่ค่าเสียหาย</label>
                        <select id="productroom_category" name="productroom_category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                            <option value="" disabled selected>เลือกหมวดหมู่</option>
                            <option value="เฟอร์นิเจอร์">เฟอร์นิเจอร์</option>
                            <option value="อุปกรณ์ไฟฟ้า">อุปกรณ์ไฟฟ้า</option>
                            <option value="ผ้า">ผ้า</option>
                            <option value="แก้ว">แก้ว</option>
                            <option value="อื่นๆ">อื่นๆ</option>
                        </select>
                        @error('productroom_category')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="repair_type" class="block mb-2 text-sm font-medium text-gray-900">ประเภคการซ่อม</label>
                        <select id="repair_type" name="repair_type"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                            <option value="" disabled selected>เลือกประเภคการซ่อม</option>
                            <option value="แจ้งซ่อม">แจ้งซ่อม</option>
                            <option value="ซื้อเปลี่ยน">ซื้อเปลี่ยน</option>

                        </select>
                        @error('repair_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">เพิ่มค่าเสียหาย</button>

                    <!-- ปุ่มยกเลิก -->
                    <a href="{{ route('productroom') }}" class="inline-block mt-4 text-center text-blue-600 hover:text-blue-800">
                        <button type="button"
                            class="text-white bg-gray-400 hover:bg-gray-500 rounded-lg text-sm px-5 py-2.5">ยกเลิก</button>
                    </a>
                </form>



            </div>
        </section>
    </div>


    <!-- Include Toastify -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>

</html>