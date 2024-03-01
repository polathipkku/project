<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="style-employee.css">
    <title>Thunthree</title>
</head>

<body>

    <div class="container">

        <aside>
            <div class="toggle">
                <div class="logo">
                    <img src="images/no bg logo.png">
                    <h2>Thun<span class="danger">three</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="#">
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="A_user.html">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>Users</h3>
                </a>
                <a href="A_employee.html" class="active">
                    <span class="material-icons-sharp">
                        badge
                    </span>
                    <h3>Employee</h3>
                </a>
                <a href="A_room.html">
                    <span class="material-icons-sharp">
                        room_preferences
                    </span>
                    <h3>Room</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        inventory
                    </span>
                    <h3>Stock</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        campaign
                    </span>
                    <h3>Promotion</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        receipt_long
                    </span>
                    <h3>History</h3>
                </a>
                <a href="A_analy.html">
                    <span class="material-icons-sharp">
                        insights
                    </span>
                    <h3>Analytics</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        mail_outline
                    </span>
                    <h3>Review</h3>
                    <span class="message-count">35</span>
                </a>

                <a href="#">
                    <span class="material-icons-sharp">
                        add
                    </span>
                    <h3>New Login</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>

        <main>
            <h1>Employee Information</h1>
            <div class="main-table">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ชื่อพนักงาน</th>
                            <th scope="col">รายละเอียดพนักงาน</th>
                            <th scope="col">วันที่สมัคร</th>
                            <th scope="col">แก้ไขพนักงาน</th>
                            <th scope="col">ลบพนักงาน</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employee as $employee)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $employee->name }}</td>
                            <td><a href="{{ url('/employeedetail') }}">รายละเอียดพนักงาน</a></td>
                            <td>{{ $employee->created_at }}</td>
                            <td><a href="{{ url('/employee/edit/'.$employee->id) }}" class="btn btn-primary">แก้ไขบัญชี</a></td>
                            </td>
                            <td>
                                <a href="{{ url('/employee/delete/'.$employee->id) }}" class="btn btn-danger">ลบบัญชี</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
        <div class="right-section">
            <div class="nav">
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b>admin</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="images/profile-1.jpg">
                    </div>
                </div>
            </div>
            <!-- End of Nav -->
            <div class="room-form">
                <h2>Add New Employee</h2>
                <form method="POST" action="{{ route('owner.create') }}" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    {{-- ส่วนของ employee information --}}
                    <div class="mt-4">
                        <x-jet-label for="tel" value="{{ __('Telephone') }}" />
                        <x-jet-input id="tel" class="block mt-1 w-full" type="text" name="tel" :value="old('tel')" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="start_date" value="{{ __('Start Date') }}" />
                        <x-jet-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date')" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="birthday" value="{{ __('Birthday') }}" />
                        <x-jet-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" :value="old('birthday')" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="address" value="{{ __('Address') }}" />
                        <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="image" value="{{ __('Image') }}" />
                        <x-jet-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')" required />
                    </div>


                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-jet-label for="terms">
                            <div class="flex items-center">
                                <x-jet-checkbox name="terms" id="terms" />
                                <div class="ml-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-jet-label>
                    </div>
                    @endif

                    {{-- เพิ่มฟิลด์ userType --}}
                    <input type="hidden" name="userType" value="1">

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button type="submit" class="ml-4">
                            {{ __('Register') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
        <script src="orders.js"></script>
        <script src="index.js"></script>
</body>