<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                    <div class="card">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">รูปพนักงาน</th>
                                    <th scope="col">ชื่อพนักงาน</th>
                                    <th scope="col">เบอร์โทรพนักงาน</th>
                                    <th scope="col">ที่อยู่พนักงาน</th>
                                    <th scope="col">วันเกิดพนักงาน</th>
                                    <th scope="col">วันที่เริ่มทำงาน</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employeedetail as $employeedetail)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td><img src="{{ asset('storage/' . $employeedetail->image) }}" alt="image" width="100px" height="100px"></td>
                                    <td>{{ $employeedetail->name }}</td>
                                    <td>{{ $employeedetail->tel }}</td>
                                    <td>{{ $employeedetail->address }}</td>
                                    <td>{{ $employeedetail->birthday }}</td>
                                    <td>{{ $employeedetail->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>