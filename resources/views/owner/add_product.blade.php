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
</head>

<body>
    <div style="display: flex; background-color: #F5F3FF;">

        @include('components.admin_sidebar')


        <section class="ml-10 bg-white" id="room-add" style="width:1100px; padding-left: 2.5%; padding-right: 2.5%;">
            <div class="max-w-4xl mx-auto py-10">
                <div class="px-4 flex justify-between items-center">
                    <h1 class="text-4xl font-bold text-gray-800">เพิ่มสินค้า</h1>
                </div>
        
                <form action="{{ route('addProduct') }}" method="post" enctype="multipart/form-data" class="mt-6 space-y-6">
                    @csrf
                    <div class="grid grid-cols-2 gap-6">
                        <!-- ชื่อสินค้า -->
                        <div>
                            <label for="product_name" class="block text-sm font-medium text-gray-700">ชื่อสินค้า</label>
                            <input type="text" name="product_name" required
                                class="mt-1 block w-full rounded-md border border-gray-400 bg-white p-3 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            @error('product_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
        
                        <!-- ราคาสินค้า -->
                        <div>
                            <label for="product_price" class="block text-sm font-medium text-gray-700">ราคาสินค้า</label>
                            <input type="text" name="product_price" required
                                class="mt-1 block w-full rounded-md border border-gray-400 bg-white p-3 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
        
                        <!-- จำนวนสินค้า -->
                        <div>
                            <label for="stock_qty" class="block text-sm font-medium text-gray-700">จำนวนสินค้า</label>
                            <input type="text" name="stock_qty" required
                                class="mt-1 block w-full rounded-md border border-gray-400 bg-white p-3 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
        
                        <!-- ประเภทสินค้า -->
                        <div>
                            <label for="product_type" class="block text-sm font-medium text-gray-700">ประเภทสินค้า</label>
                            <select name="product_type_name" id="product_type" required
                                class="mt-1 block w-full rounded-md border border-gray-400 bg-white p-3 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="" selected disabled>เลือกประเภทสินค้า</option>
                                <option value="เครื่องดื่ม">เครื่องดื่ม</option>
                                <option value="เครื่องนอน">เครื่องนอน</option>
                            </select>
                        </div>
        
                        <!-- สถานะสินค้า -->
                        <div>
                            <label for="product_status" class="block text-sm font-medium text-gray-700">สถานะสินค้า</label>
                            <select name="product_status" id="product_status" required
                                class="mt-1 block w-full rounded-md border border-gray-400 bg-white p-3 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="พร้อมให้บริการ">พร้อมให้บริการ</option>
                                <option value="ไม่พร้อมให้บริการ">ไม่พร้อมให้บริการ</option>
                            </select>
                        </div>
        
                        <!-- รูปสินค้า -->
                        <div >
                            <label for="product_img" class="block text-sm font-medium text-gray-700">รูปสินค้า</label>
                            <input type="file" name="product_img" accept="image/*" required
                                class="mt-1 block w-full rounded-md border border-gray-400 bg-white p-3 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
        
                    <!-- ปุ่มกด -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('product') }}"
                            class="text-gray-600 border border-gray-400 hover:bg-gray-100 px-5 py-2.5 rounded-lg text-sm">
                            ยกเลิก
                        </a>
                        <button type="submit"
                            class="text-white bg-blue-600 hover:bg-blue-700 px-5 py-2.5 rounded-lg text-sm shadow">
                            สร้างสินค้า
                        </button>
                    </div>
                </form>
            </div>
        </section>
        

    </div>

</body>

</html>
