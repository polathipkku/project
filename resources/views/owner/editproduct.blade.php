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
            <div class="max-w-screen-xl mx-auto py-10">
                <div class="px-2 p-2 flex justify-between items-center">
                    <h1 class="text-4xl mb-10 max-xl:px-4">แก้ไขสินค้า</h1>
                    <button class="relative pr-12 mb-4 group">
                        <!-- ปุ่มอื่นๆ ที่คุณต้องการเพิ่ม -->
                    </button>
                </div>
                <form action="{{ route('updateProduct', $product->id) }}" method="post" enctype="multipart/form-data"
                    id="updateProductForm">
                    @csrf

                    <!-- แถวที่ 1: ชื่อสินค้าและราคาสินค้า -->
                    <div class="grid grid-cols-3 gap-6 mb-6">
                        <div>
                            <label for="product_name"
                                class="block mb-2 text-sm font-medium text-gray-900">ชื่อสินค้า</label>
                            <input type="text" id="product_name" name="product_name"
                                value="{{ old('product_name', $product->product_name) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                required />
                            @error('product_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="product_price"
                                class="block mb-2 text-sm font-medium text-gray-900">ราคาสินค้า</label>
                            <input type="text" id="product_price" name="product_price"
                                value="{{ old('product_price', $product->product_price) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                required />
                        </div>
                        <div>
                            <label for="stock_qty"
                                class="block mb-2 text-sm font-medium text-gray-900">จำนวนสินค้า</label>
                            <input type="text" id="stock_qty" name="stock_qty"
                                value="{{ old('stock_qty', $product->stock->stock_qty ?? '') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                        </div>
                    </div>



                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="product_type"
                                class="block mb-2 text-sm font-medium text-gray-900">ประเภทสินค้า</label>
                            <select id="product_type" name="product_type_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                required>
                                <option value="" selected disabled>เลือกประเภทสินค้า</option>
                                @foreach ($product_types as $product_type)
                                    <option value="{{ $product_type }}"
                                        {{ $product->product_type_name == $product_type ? 'selected' : '' }}>
                                        {{ $product_type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="product_status"
                                class="block mb-2 text-sm font-medium text-gray-900">สถานะสินค้า</label>
                            <select id="product_status" name="product_status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                required>
                                <option value="พร้อมให้บริการ"
                                    {{ $product->product_status == 'พร้อมให้บริการ' ? 'selected' : '' }}>พร้อมให้บริการ
                                </option>
                                <option value="ไม่พร้อมให้บริการ"
                                    {{ $product->product_status == 'ไม่พร้อมให้บริการ' ? 'selected' : '' }}>
                                    ไม่พร้อมให้บริการ</option>
                            </select>
                        </div>
                    </div>

                    <!-- แถวที่ 4: รายละเอียดสินค้า -->
                    <div class="mb-6">
                        <label for="product_detail"
                            class="block mb-2 text-sm font-medium text-gray-900">รายละเอียดสินค้า</label>
                        <textarea id="product_detail" name="product_detail"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">{{ old('product_detail', $product->product_detail) }}</textarea>
                    </div>

                    <!-- แถวที่ 5: รูปสินค้า -->
                    <div class="mb-6">
                        <label for="product_img" class="block mb-2 text-sm font-medium text-gray-900">รูปสินค้า</label>
                        <input type="file" id="product_img" name="product_img"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                        <!-- แสดงรูปภาพปัจจุบัน -->
                        @if ($product->product_img)
                            <img src="{{ asset('images/' . $product->product_img) }}" alt="Product Image"
                                class="mt-2" style="max-width: 300px; max-height: 200px;">
                        @else
                            <p class="mt-2 text-gray-600">No image available</p>
                        @endif
                    </div>

                    <!-- ปุ่มอัพเดทและยกเลิก -->
                    <div class="flex space-x-4">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm px-5 py-2.5">อัพเดทสินค้า</button>
                        <a href="{{ route('product') }}"
                            class="inline-block text-center text-blue-600 hover:text-blue-800">
                            <button type="button"
                                class="text-white bg-gray-400 hover:bg-gray-500 rounded-lg text-sm px-5 py-2.5">ยกเลิก</button>
                        </a>
                    </div>
                </form>
            </div>
        </section>

    </div>

</body>

</html>
