<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            รายชื่อสินค้า
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <!-- <div class="col-md-8">
                    @if(session("success"))
                    <div class="alert alert-success">{{session("success")}}</div>
                    @endif
                    <div class="card">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">ชื่อสินค้า</th>
                                    <th scope="col">แก้ไขห้อง</th>
                                    <th scope="col">ลบห้อง</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"></th>
                                    <td><a href="" class="btn btn-primary">แก้ไขสินค้า</a></td>
                                    <td><a href="" class="btn btn-danger">ลบสินค้า</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">แบบฟอร์หหหม</div>
                        <div class="card-body">
                            <form action="{{ route('addProductroom') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="room-group">
                                    <label for="productroom_name">ชื่อสินค้า</label>
                                    <input type="text" class="form-control" name="productroom_name" required>
                                    @error('productroom_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <br>
                                <div class="room-group">
                                    <label for="productroom_price">ราคาค่าปรับ</label>
                                    <input type="text" class="form-control" name="productroom_price" required>
                                    @error('productroom_price')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
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