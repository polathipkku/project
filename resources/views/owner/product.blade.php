<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            รายชื่อสินค้า
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @if(session("success"))
                    <div class="alert alert-success">{{session("success")}}</div>
                    @endif
                    <div class="card">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">ชื่อสินค้า</th>
                                    <th scope="col">รายละเอียดสินค้า</th>
                                    <th scope="col">แก้ไขห้อง</th>
                                    <th scope="col">ลบห้อง</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product as $productItem)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $productItem->product_name }}</td>
                                    <td>
                                        <a href="{{ url('/roomdetail') }}">รายละเอียดสินค้า</a>
                                    </td>
                                    <td><a href="{{url('/product/edit/'.$productItem->id)}}" class="btn btn-primary">แก้ไขสินค้า</a></td>
                                    <td><a href="{{url('/product/delete/'.$productItem->id)}}" class="btn btn-danger">ลบสินค้า</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">แบบฟอร์ม</div>
                        <div class="card-body">
                            <form action="{{ route('addProduct') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="room-group">
                                    <label for="product_name">ชื่อสินค้า</label>
                                    <input type="text" class="form-control" name="product_name">
                                    @error('product_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <br>
                                <div class="room-group">
                                    <label for="product_price">ราคาสินค้า</label>
                                    <input type="text" class="form-control" name="product_price">
                                </div>
                                <br>
                                <div class="room-group">
                                    <label for="stock_qty">จำนวนสินค้า</label>
                                    <input type="text" class="form-control" name="stock_qty">
                                </div>
                                <br>
                                <div class="room-group">
                                    <label for="product_detail">รายละเอียดสินค้า</label>
                                    <textarea class="form-control" name="product_detail"></textarea>
                                </div>
                                <br>
                                <div class="room-group">
                                    <label for="product_img">รูปสินค้า</label>
                                    <input type="file" class="form-control" name="product_img">
                                </div>
                                <br>
                                <div class="room-group">
                                    <label for="product_type">ประเภทสินค้า</label>
                                    <!-- <div>
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
                                    <div>
                                        <select class="form-select" name="product_type_name" id="product_type" required>
                                            <option value="" selected disabled>เลือกประเภทสินค้า</option>
                                            <option value="เครื่องดื่ม">เครื่องดื่ม</option>
                                            <option value="เครื่องนอน">เครื่องนอน</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="room-group">
                                    <label for="product_status">สถานะสินค้า</label>
                                    <div>
                                        <select class="form-select" name="product_status" id="product_status" required>
                                            <option value="พร้อมให้บริการ">พร้อมให้บริการ</option>
                                            <option value="ไม่พร้อมให้บริการ">ไม่พร้อมให้บริการ</option>
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