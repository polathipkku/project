<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link href="css/style-admin.css" rel="stylesheet" />
    <title>Thaitaree</title>
</head>

<body>

    <div class="container">

        <aside>
            <div class="toggle">
                <div class="logo">
                    <img src="images/no bg logo.png">
                    <h2>Thai<span class="danger">taree</span></h2>
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
                <a href="{{ route('dashboard') }}">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>Users</h3>
                </a>
                <a href="{{ route('employee') }}">
                    <span class="material-icons-sharp">
                        badge
                    </span>
                    <h3>Employee</h3>
                </a>
                <a href="#" class="active">
                    <span class="material-icons-sharp">
                        room_preferences
                    </span>
                    <h3>Room</h3>
                </a>
                <a href="{{ route('product') }}">
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
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>Logout</h3>
                </a>

                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                    @csrf
                </form>
            </div>
        </aside>

        <main>
            <h1>Room Information</h1>
            <div class="main-table">
                <table>
                    <thead>
                        <tr>
                            <th>Room Name</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rooms as $room)
                        <tr>
                            <td>{{ $room->room_name }}</td>
                            <td>
                                <a href="{{ url('/roomdetail') }}" class="detail">
                                    <button class="detail" type="button">Detail</button>
                                </a>
                            </td>
                            <td>{{ $room->room_status }}</td>
                            <td>
                                <a href="{{ url('/room/edit/'.$room->id) }}" class="edit">
                                    <button type="button">Edit</button>
                                </a>
                                <a href="{{ url('/room/delete/'.$room->id) }}" class="delete-link">
                                    <button class="delete" type="button">Delete</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
        <div class="right-section">
            <div class="room-form">
                <h2>Add New Room</h2>
                <form action="{{ route('addRoom') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="room-group">
                        <label for="room_name">ชื่อห้อง</label>
                        <input type="text" class="form-control" name="room_name">
                        @error('room_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="room-group">
                        <label for="room_occupancy">จำนวนที่สามารถเข้าพัก</label>
                        <input type="text" class="form-control" name="room_occupancy">
                    </div>
                    <div class="room-group">
                        <label for="room_bed">จำนวนเตียง</label>
                        <input type="text" class="form-control" name="room_bed">
                    </div>
                    <div class="room-group">
                        <label for="room_bathroom">จำนวนห้องน้ำ</label>
                        <input type="text" class="form-control" name="room_bathroom">
                    </div>
                    <div class="room-group">
                        <label for="room_description">รายละเอียดห้อง</label>
                        <textarea class="form-control" name="room_description"></textarea>
                    </div>
                    <div class="room-group">
                        <label for="price_night">ราคาค้างคืน</label>
                        <input type="text" class="form-control" name="price_night">
                    </div>
                    <div class="room-group">
                        <label for="price_temporary">ราคาชั่วคราว</label>
                        <input type="text" class="form-control" name="price_temporary">
                    </div>
                    <div class="room-group">
                        <label for="room_image">รูปห้อง</label>
                        <input type="file" class="form-control" name="room_image">
                    </div>


                    <div class="room-group">
                        <label for="room_status">สถานะห้อง</label>
                        <div>
                            <select id="room_status" name="room_status" required>
                                <option value="พร้อมให้บริการ">พร้อมให้บริการ</option>
                                <option value="ไม่พร้อมให้บริการ">ไม่พร้อมให้บริการ</option>
                            </select>
                        </div>
                    </div>
                    <input type="submit" value="บันทึก">
                </form>
            </div>
        </div>
    </div>
    <script src="orders.js"></script>
    <script src="index.js"></script>
</body>

</html>