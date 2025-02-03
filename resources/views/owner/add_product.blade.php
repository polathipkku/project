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
            <div class="max-w-screen-xl mx-auto py-10 ">
                <div class="px-2 p-2  flex justify-between items-center">
                    <h1 class="text-4xl mb-10 max-xl:px-4">เพิ่มสินค้า</h1>
                    <button class="relative pr-12 mb-4 group">
                    </button>
                </div>

                <form action="{{ route('addProduct') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="product_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ชื่อสินค้า</label>
                        <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="product_name" required>
                        @error('product_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    <div>
                        <label for="product_price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ราคาสินค้า</label>
                        <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="product_price" required>
                    </div>
                    <br>
                    <div>
                        <label for="stock_qty" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">จำนวนสินค้า</label>
                        <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="stock_qty" required>
                    </div>
                    <br>    
                    <br>
                    <div>
                        <label for="product_img" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">รูปสินค้า</label>
                        <input type="file" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="product_img" required>
                    </div>
                    <br>
                    <!-- <div>
                        <label for="product_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ประเภทสินค้า</label>
                        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="product_type_name" id="product_type" required>
                            <option value="" selected disabled>เลือกประเภทสินค้า</option>
                            @php
                            $uniqueProductTypes = array_unique($product_types);
                            @endphp
                            @foreach($uniqueProductTypes as $product_type)
                            <option value="{{ $product_type }}">{{ $product_type }}</option>
                            @endforeach
                        </select>
                    </div> -->

                    <!-- <div class="room-group">
                        <label for="product_type">ประเภทสินค้า</label>
                        <div>
                            <select class="form-select" name="product_type_name" id="product_type" required>
                                <option value="" selected disabled>เลือกประเภทสินค้า</option>
                                @php
                                $uniqueProductTypes = array_unique($product_types);
                                @endphp

                                @foreach($uniqueProductTypes as $product_type)
                                <option value="{{ $product_type }}">{{ $product_type }}</option>
                                @endforeach
                            </select>
                        </div> -->
                    <div class="mb-4">
                        <label for="product_type" class="block text-sm font-medium text-gray-700">ประเภทสินค้า</label>
                        <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="product_type_name" id="product_type" required>
                            <option value="" selected disabled>เลือกประเภทสินค้า</option>
                            <option value="เครื่องดื่ม">เครื่องดื่ม</option>
                            <option value="เครื่องนอน">เครื่องนอน</option>
                        </select>
                    </div>

            </div>

            <br>
            <div>
                <label for="product_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">สถานะสินค้า</label>
                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="product_status" id="product_status" required>
                    <option value="พร้อมให้บริการ">พร้อมให้บริการ</option>
                    <option value="ไม่พร้อมให้บริการ">ไม่พร้อมให้บริการ</option>
                </select>
            </div>
            <br>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">สร้างสินค้า</button>

            <!-- ปุ่มยกเลิก -->
            <a href="{{ route('product') }}"
                class="inline-block mt-4 text-center text-blue-600 hover:text-blue-800">
                <button type="button"
                    class="text-white bg-gray-400 hover:bg-gray-500 rounded-lg text-sm px-5 py-2.5">ยกเลิก</button>
            </a>
            </form>



    </div>
    </section>

    </div>

</body>

</html>