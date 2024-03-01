<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            แก้ไขสินค้า
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">แบบฟอร์ม</div>
                        <div class="card-body">
                            <form action="{{ route('updateProduct', $product->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="room-group">
                                    <label for="product_name">ชื่อสินค้า</label>
                                    <input type="text" class="form-control" name="product_name" value="{{ $product->product_name }}">
                                    @error('product_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <br>
                                <div class="room-group">
                                    <label for="product_price">ราคาสินค้า</label>
                                    <input type="text" class="form-control" name="product_price" value="{{ $product->product_price }}">
                                </div>
                                <br>
                                <div class="room-group">
                                    <label for="stock_qty">จำนวนสินค้า</label>
                                    <input type="text" class="form-control" name="stock_qty" value="{{ $product->stock_qty ?? '' }}">
                                </div>
                                <br>
                                <div class="room-group">
                                    <label for="product_detail">รายละเอียดสินค้า</label>
                                    <textarea class="form-control" name="product_detail">{{ $product->product_detail }}</textarea>
                                </div>
                                <br>
                                <div class="room-group">
                                    <label for="product_img">รูปสินค้า</label>
                                    <input type="file" class="form-control" name="product_img">
                                    <!-- แสดงรูปภาพปัจจุบัน -->
                                    @if ($product->product_img)
                                    <img src="{{ asset('images/' . $product->product_img) }}" alt="Product Image" style="max-width: 300px; max-height: 200px; margin-top: 10px;">
                                    @else
                                    <p>No image available</p>
                                    @endif
                                </div>
                                <br>
                                <div class="room-group">
                                    <label for="product_type">ประเภทสินค้า</label>
                                    <div>
                                        <select class="form-select" name="product_type_name" id="product_type" required>
                                            <option value="" selected disabled>เลือกประเภทสินค้า</option>
                                            @foreach($product_types as $product_type)
                                            <option value="{{ $product_type }}" {{ $product->product_type_name == $product_type ? 'selected' : '' }}>{{ $product_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="room-group">
                                    <label for="product_status">สถานะสินค้า</label>
                                    <div>
                                        <select class="form-select" name="product_status" id="product_status" required>
                                            <option value="พร้อมให้บริการ" {{ $product->product_status == 'พร้อมให้บริการ' ? 'selected' : '' }}>พร้อมให้บริการ</option>
                                            <option value="ไม่พร้อมให้บริการ" {{ $product->product_status == 'ไม่พร้อมให้บริการ' ? 'selected' : '' }}>ไม่พร้อมให้บริการ</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <input type="submit" value="บันทึก" class="btn btn-primary">
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>