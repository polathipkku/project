<!DOCTYPE html>
<html lang="th">

<head>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ใบเสร็จรับเงิน</title>
    <style>
        body {
            font-family: 'Noto Sans Thai', 'THSarabunNew', sans-serif;
            font-size: 16px;
            line-height: 1.3;
            margin: 0;
            padding: 15px;
            color: #333;
        }

        .receipt-container {
            max-width: 700px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
        }

        .header-table {
            width: 100%;
            margin-bottom: 15px;
            border-collapse: collapse;
        }

        .company-logo {
            width: 80px;
            height: auto;
        }

        .company-name {
            font-size: 20px;
            margin-bottom: 3px;
            font-family: "Noto Sans Thai", sans-serif;
            font-weight: 700;
        }

        .phone-name .label {
            font-size: 12px;
            font-family: "Noto Sans Thai", sans-serif;
            font-weight: 700;
        }

        .phone-name .number {
            font-size: 12px;
            font-family: "Noto Sans Thai", sans-serif;
            font-weight: normal;
        }

        .label {
            font-family: "Noto Sans Thai", sans-serif;
            font-weight: bold;
            font-size: 12px;
        }

        .room-cost {
            font-family: "Noto Sans Thai", sans-serif;
            font-weight: bold;
            font-size: 12px;
        }

        .ss {
            font-family: "Noto Sans Thai", sans-serif;
            font-weight: bold;
            font-size: 12px;
        }

        .info {
            font-family: "Noto Sans Thai", sans-serif;
            font-weight: normal;
            font-size: 12px;
        }

        .receipt-title {
            font-size: 20px;
            text-align: right;
        }

        .info-box {
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 15px;
            padding: 8px;
            font-family: 'Noto Sans Thai', 'THSarabunNew', sans-serif;
        }

        .info-table {
            width: 100%;
            margin-bottom: 15px;
        }

        .info-table td {
            padding: 3px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            border: 1px solid #ddd;
        }

        .items-table th {
            background-color: #f8f9fa;
            padding: 6px;
            border-bottom: 1px solid #ddd;
            font-size: 15px;
            text-align: center;
            font-family: 'THSarabunNew', sans-serif;
        }

        .items-table td {
            padding: 6px;
            border-bottom: 1px solid #ddd;
            font-size: 15px;
        }

        .summary-table {
            width: 250px;
            margin-left: auto;
            margin-bottom: 15px;
        }

        .summary-table td {
            padding: 4px;
        }

        .total-row {
            font-size: 18px;
            border-top: 1px solid #ddd;
        }

        .signature-section {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .signature-box {
            text-align: center;
            width: 45%;
        }

        .signature-line {
            border-bottom: 1px solid #999;
            width: 160px;
            margin: 5px auto;
        }

        .notes-section {
            margin-top: 15px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 4px;
            font-size: 14px;
        }

        .notes-section h3 {
            margin: 0 0 5px 0;
            font-size: 16px;
        }

        .notes-section ul {
            margin: 0;
            padding-left: 20px;
        }

        .notes-section li {
            margin-bottom: 3px;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        * {
            font-family: 'THSarabunNew', sans-serif;
        }

        th {
            font-size: 15px;
            font-family: "Noto Sans Thai", sans-serif;
            font-weight: 700;
        }

        strong {
            font-family: "Noto Sans Thai", sans-serif;
            font-weight: bold;
        }

        .info-box label,
        .info-box strong {
            font-family: "Noto Sans Thai", sans-serif;
        }

        .items-table td {
            vertical-align: middle;
        }

        .number {
            font-size: 12px;
            font-family: "Noto Sans Thai", sans-serif;
            font-weight: normal;
        }

        .address {
            font-size: 12px;
            font-family: "Noto Sans Thai", sans-serif;
            font-weight: normal;
            white-space: nowrap;
        }




        .label {
            font-family: "Noto Sans Thai", sans-serif;
            font-weight: normal;
            font-size: 12px;
        }
        .dd {
            font-family: "Noto Sans Thai", sans-serif;
            font-weight: bold;
            font-size: 12px;
        }

        .t {
            font-size: 12px;
            font-family: "Noto Sans Thai", sans-serif;
            font-weight: bold;
        }

        .tt {
            font-family: "Noto Sans Thai", sans-serif;
            font-weight: bold;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <!-- Header Section -->
        <table class="header-table">
            <tr>
                <td width="15%">
                    <img src="images/Logo.jpg" class="company-logo" alt="Logo">
                </td>
                <td width="50%">
                    <div class="company-name">ธันย์ทรีรีสอร์ท</div>
                    <div>
                        <span class="label" style="font-weight: bold;">ที่อยู่:</span><br>
                        <span class="address">52 หมู่15 ตำบลบัวขาว, อำเภอกุฉินารายณ์, จังหวัดกาฬสินธุ์, 46110</span>
                    </div>

                    <div class="phone-name">
                        <span class="label">โทรศัพท์:</span> <span class="number">094-002-8212</span>
                    </div>

                    <div class="phone-name">
                        <span class="label">เลขประจำตัวผู้เสียภาษี:</span> <span class="number">562-463-892-3021</span>
                    </div>
                </td>
                <td width="35%" style="text-align: right;">
                    <div class="receipt-title">ใบเสร็จรับเงิน</div>
                    <div>ต้นฉบับ</div>
                </td>
            </tr>
        </table>

        <!-- Customer Info -->
        <div class="info-box">
            <table class="info-table">
                <tr>
                    <td width="50%">
                        <span class="dd">ชื่อลูกค้า:</span> <span class="info">{{ $customer_name }}</span><br>
                        <span class="dd">เบอร์โทร:</span> <span class="info">{{ $customer_phone }}</span><br>
                        <span class="dd">หมายเลขการจอง:</span> <span class="info">{{ $booking->booking_random_id }}</span>
                    </td>
                    <td width="50%" style="text-align: right;">
                        <span class="dd">เลขที่ใบเสร็จ:</span> <span class="info">{{ $receipt_number }}</span><br>
                        <span class="dd">วันที่ออกใบเสร็จ:</span> <span class="info">{{ $date }}</span><br>
                    </td>
                </tr>
            </table>
        </div>


        <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
            <tr class="ttt">
                <th style="width: 65%; border: 1px solid #ccc; padding: 8px; text-align: center; font-weight: bold;">รายละเอียด</th>
                <th style="width: 35%; border: 1px solid #ccc; padding: 8px; text-align: center; font-weight: bold;">ค่าใช้จ่าย</th>
            </tr>


            <tr>
                <td style="border: 1px solid #ccc; padding: 8px; vertical-align: top; font-family: 'THSarabunNew', sans-serif;">
                    <table style="width: 100%; border-collapse: collapse;">
                        @php
                        $totalAmount = 0;
                        @endphp
                        @foreach($booking->bookingDetails as $index => $detail)
                        <tr class="room-details">
                            <td class="label" style="width: 35%; font-weight: bold;">รายละเอียดห้องพัก:</td>
                            <td>{{ $detail->room->name }} ประเภท: {{ $detail->room_type }}</td>
                        </tr>
                        <tr class="room-details">
                            <td class="label" style="font-weight: bold;">จำนวนห้อง:</td>
                            <td>{{ $booking->room_quantity }} ห้อง</td>
                        </tr>
                        <tr class="room-details">
                            <td class="label" style="font-weight: bold;">จำนวนเตียงเสริม:</td>
                            <td>{{ $detail->extra_bed_count }} เตียง</td>
                        </tr>
                        <tr class="room-details">
                            <td class="label" style="font-weight: bold;">วันที่เวลาการเข้าพัก:</td>
                            <td>{{ \Carbon\Carbon::parse($detail->checkin_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($detail->checkout_date)->format('d/m/Y') }}</td>
                        </tr>
                        <tr class="room-details">
                            <td class="label" style="font-weight: bold;">จำนวนคน:</td>
                            <td>ผู้ใหญ่: {{ $detail->occupancy_person }}
                                @if($detail->occupancy_child > 0)
                                เด็ก: {{ $detail->occupancy_child }}
                                @endif
                                @if($detail->occupancy_baby > 0)
                                ทารก: {{ $detail->occupancy_baby }}
                                @endif
                            </td>
                        </tr>
                        <tr style="height: 24px;">
                            <td class="room-cost" style="width: 35%; font-weight: bold;">ค่าห้องทั้งหมด:</td>
                            <td style="text-align: right;">
                                <span class="number" style="visibility: hidden;">{{ $room_cost }}</span> <span class="label" style="visibility: hidden;">บาท</span>
                            </td>
                        </tr>
                        <tr style="height: 24px;">
                            <td class="room-cost" style="width: 35%; font-weight: bold;">ค่าเตียงเสริมทั้งหมด:</td>
                            <td style="text-align: right;">
                                <span class="number" style="visibility: hidden;">{{ $extra_bed_cost }}</span> <span class="label" style="visibility: hidden;">บาท</span>
                            </td>
                        </tr>
                        <tr style="border-top: 1px solid #ccc;">
                            <td class="ss text-right" colspan="2">ยอดรวมทั้งหมด:</td>
                        </tr>

                        @endforeach
                    </table>
                </td>
                <td style="border: 1px solid #ccc; padding: 8px; vertical-align: top; font-family: 'THSarabunNew', sans-serif;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr style="height: 150px;">
                            <td></td>
                        </tr>
                        <tr style="height: 24px;">
                            <td style="text-align: right;">&nbsp;</td>
                        </tr>
                        <tr style="height: 24px;">
                            <td style="text-align: right;">&nbsp;</td>
                        </tr>
                        <tr style="height: 24px;">
                            <td style="text-align: right;">&nbsp;</td>
                        </tr>
                        <tr style="height: 24px;">
                            <td style="text-align: right;">&nbsp;</td>
                        </tr>
                        <tr style="height: 24px;">
                            <td style="text-align: right;">&nbsp;</td>
                        </tr>
                        <tr style="height: 24px;">
                            <td style="text-align: right;">
                                <span class="number">{{ $room_cost }}</span> <span class="label">บาท</span>
                            </td>
                        </tr>
                        <tr style="height: 24px;">
                            <td style="text-align: right;">
                                <span class="number">{{ $extra_bed_cost }}</span> <span class="label">บาท</span>
                            </td>
                        </tr>
                        <tr style="height: 24px;">
                            <td style="text-align: right;">
                                <span class="t">{{ number_format($booking->total_cost, 2) }}</span> <span class="tt">บาท</span>
                            </td>
                        </tr>


                    </table>
                </td>
            </tr>
        </table>




        <style>
            .table-spacing td {
                padding: 20px;
                /* เพิ่มระยะห่างภายในช่อง */
            }
        </style>

        <div style="display: flex; justify-content: space-between;">
            <!-- Notes Section -->
            <div class="notes-section" style="width: 60%;">
                <h3 style="font-family: 'THSarabunNew'; font-weight: normal; font-size: 21px;">หมายเหตุ:</h3>
                <ul>
                    <li>กรุณาแสดงใบเสร็จนี้เมื่อเข้าพัก</li>
                    <li>เวลาเช็คอิน: 14:00 น. / เช็คเอาท์: 12:00 น.</li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>