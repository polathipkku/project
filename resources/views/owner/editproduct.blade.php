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

        <section class="sticky bg-white rounded-2xl p-2" id="nav-content" style="height: 100vh; width: 180px; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; margin-left: 2%; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">
            <div class="w-full lg:w-auto flex-grow lg:flex lg:flex-col bg-white lg:bg-transparent text-black">

                <div style="display: grid; place-items: center; margin-bottom: 30px;">
                    <img src="images/Logo.jpg" alt="Logo" style="width: 80px; height: auto; margin-bottom: -10px;">
                    <div class="text-black text-lg ">Tunthree</div>
                </div>


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

                <a class="inline-block py-2 px-3 text-blue-700 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="Room.html">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-door-open mr-1"></i>Room
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="#" id="Stock">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-house-circle-check mr-1"></i>Stock
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="#" id="Promotion">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-rectangle-ad mr-1"></i>Promotion
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="#" id="Review">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-regular fa-envelope mr-1"></i>Review
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-6 transition duration-300 ease-in-out hover:bg-transparent hover:text-red-500 hover:text-sm" href="#" style="position: absolute; bottom: 10px;" id="Logout">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-right-from-bracket mr-1"></i>Logout
                    </div>
                </a>
            </div>
        </section>


        <section class="ml-10 bg-white" id="room-add" style="width:1100px; padding-left: 2.5%; padding-right: 2.5%;">
            <div class="max-w-screen-xl mx-auto py-10 ">
                <div class="px-2 p-2  flex justify-between items-center">
                    <h1 class="text-4xl mb-10 max-xl:px-4">แก้ไขห้อง</h1>
                    <button class="relative pr-12 mb-4 group">
                    </button>
                </div>
                <form action="{{ route('updateProduct', $product->id) }}" method="post" enctype="multipart/form-data" id="updateProductForm">
                    @csrf

                    <div class="mb-6">
                        <label for="product_name" class="block mb-2 text-sm font-medium text-gray-900">ชื่อสินค้า</label>
                        <input type="text" id="product_name" name="product_name"
                            value="{{ old('product_name', $product->product_name) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required />
                        @error('product_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="product_price" class="block mb-2 text-sm font-medium text-gray-900">ราคาสินค้า</label>
                        <input type="text" id="product_price" name="product_price"
                            value="{{ old('product_price', $product->product_price) }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required />
                    </div>

                    <div class="mb-6">
                        <label for="stock_qty" class="block mb-2 text-sm font-medium text-gray-900">จำนวนสินค้า</label>
                        <input type="text" id="stock_qty" name="stock_qty"
                            value="{{ old('stock_qty', $product->stock_qty ?? '') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                    </div>

                    <div class="mb-6">
                        <label for="product_detail" class="block mb-2 text-sm font-medium text-gray-900">รายละเอียดสินค้า</label>
                        <textarea id="product_detail" name="product_detail"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">{{ old('product_detail', $product->product_detail) }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label for="product_img" class="block mb-2 text-sm font-medium text-gray-900">รูปสินค้า</label>
                        <input type="file" id="product_img" name="product_img"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                        <!-- แสดงรูปภาพปัจจุบัน -->
                        @if ($product->product_img)
                        <img src="{{ asset('images/' . $product->product_img) }}" alt="Product Image" class="mt-2" style="max-width: 300px; max-height: 200px;">
                        @else
                        <p class="mt-2 text-gray-600">No image available</p>
                        @endif
                    </div>

                    <div class="mb-6">
                        <label for="product_type" class="block mb-2 text-sm font-medium text-gray-900">ประเภทสินค้า</label>
                        <select id="product_type" name="product_type_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                            <option value="" selected disabled>เลือกประเภทสินค้า</option>
                            @foreach($product_types as $product_type)
                            <option value="{{ $product_type }}" {{ $product->product_type_name == $product_type ? 'selected' : '' }}>{{ $product_type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="product_status" class="block mb-2 text-sm font-medium text-gray-900">สถานะสินค้า</label>
                        <select id="product_status" name="product_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                            <option value="พร้อมให้บริการ" {{ $product->product_status == 'พร้อมให้บริการ' ? 'selected' : '' }}>พร้อมให้บริการ</option>
                            <option value="ไม่พร้อมให้บริการ" {{ $product->product_status == 'ไม่พร้อมให้บริการ' ? 'selected' : '' }}>ไม่พร้อมให้บริการ</option>
                        </select>
                    </div>

                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm w-full sm:w-auto px-5 py-2.5">อัพเดทสินค้า</button>

                    <!-- ปุ่มยกเลิก -->
                    <a href="{{ route('product') }}" class="inline-block mt-4 text-center text-blue-600 hover:text-blue-800">
                        <button type="button" class="text-white bg-gray-400 hover:bg-gray-500 rounded-lg text-sm px-5 py-2.5">ยกเลิก</button>
                    </a>
                </form>


            </div>
        </section>

    </div>

</body>

</html>