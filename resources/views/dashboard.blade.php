<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('รายชื่อผู้ใช้ทั้งหมด') }}
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
                                <th scope="col">ชื่อ</th>
                                <th scope="col">อีเมล</th>
                                <th scope="col">วันที่สมัคร</th>
                                <th scope="col">สถานะบัญชี</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $users)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $users->name }}</td>
                                <td>{{ $users->email }}</td>
                                <td>{{ $users->created_at }}</td>
                                <td >
                                    @if($users->userType == 0)
                                    <button class="btn btn-danger" style="width: 100px; height: 30px;">{{ __('Admin') }}</button>
                                    @elseif($users->userType == 1)
                                    <button class="btn btn-success" style="width: 100px; height: 30px;">{{ __('Employee') }}</button>
                                    @elseif($users->userType == 2)
                                    <button class="btn btn-primary" style="width: 100px; height: 30px;">{{ __('User') }}</button>
                                    @else
                                    <button class="btn btn-secondary">{{ __('Unknown UserType') }}</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
</x-app-layout>