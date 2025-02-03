<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ใบเสร็จรับเงิน</title>
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            src: url('/storage/fonts/THSarabunNew.ttf') format('truetype');
        }

        body {
            font-family: 'THSarabunNew';
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
            font-size: 22px;
            color: #2c3e50;
            margin-bottom: 3px;
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

        /* กำหนด font-family สำหรับทุก element */
        * {
            font-family: 'THSarabunNew', sans-serif;
        }

        /* กำหนดเฉพาะสำหรับ th */
        th {
            font-family: 'THSarabunNew', sans-serif !important;
            font-weight: normal;
        }

        /* กำหนดเฉพาะสำหรับ strong */
        strong {
            font-family: 'THSarabunNew', sans-serif !important;
            font-weight: bold;
        }

        /* ปรับแก้ class info-box */
        .info-box {
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 15px;
            padding: 8px;
            font-family: 'THSarabunNew', sans-serif;
        }

        /* ปรับแก้ table headers */
        .items-table th {
            background-color: #f8f9fa;
            padding: 6px;
            border-bottom: 1px solid #ddd;
            font-size: 15px;
            text-align: center;
            font-family: 'THSarabunNew', sans-serif !important;
        }

        /* เพิ่ม rule สำหรับ label ใน info-box */
        .info-box label,
        .info-box strong {
            font-family: 'THSarabunNew', sans-serif !important;
        }

        .items-table td {
            vertical-align: middle;
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
                    <div>52 หมู่15 ตำบลบัวขาว, อำเภอกุฉินารายณ์, จังหวัดกาฬสินธุ์, 46110</div>
                    <div>โทรศัพท์: 02-xxx-xxxx</div>
                    <div>เลขประจำตัวผู้เสียภาษี: xxxxxxxxxxxxx</div>
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
                        <strong style="font-family: 'THSarabunNew'; font-weight: normal; font-size: 18px;">ชื่อลูกค้า:</strong> {{ $customer_name }}<br>
                        <strong style="font-family: 'THSarabunNew'; font-weight: normal; font-size: 18px;">เบอร์โทร:</strong> {{ $customer_phone }}<br>
                        <strong style="font-family: 'THSarabunNew'; font-weight: normal; font-size: 18px;">หมายเลขการจอง:</strong> {{ $booking->booking_random_id }}
                    </td>
                    <td width="50%" style="text-align: right;">
                        <strong style="font-family: 'THSarabunNew'; font-weight: normal; font-size: 18px;">เลขที่ใบเสร็จ:</strong> {{ $receipt_number }}<br>
                        <strong style="font-family: 'THSarabunNew'; font-weight: normal; font-size: 18px;">วันที่ออกใบเสร็จ:</strong> {{ $date }}<br>
                    </td>
                </tr>
            </table>
        </div>

        <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
            <tr>
                <th style="width: 65%; border: 1px solid #ccc; padding: 8px; text-align: center;">รายละเอียด</th>
                <th style="width: 35%; border: 1px solid #ccc; padding: 8px; text-align: center;">ค่าใช้จ่าย</th>
            </tr>
            <tr>
                <td style="border: 1px solid #ccc; padding: 8px; vertical-align: top;">
                    <table style="width: 100%; border-collapse: collapse;">
                        @php
                        $totalAmount = 0;
                        @endphp
                        @foreach($booking->bookingDetails as $index => $detail)
                        <tr>
                            <td style="width: 35%;">รายละเอียดห้องพัก:</td>
                            <td>{{ $detail->room->name }} ประเภท: {{ $detail->room_type }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>จำนวนห้อง: {{ $booking->room_quantity }} ห้อง</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>จำนวนเตียงเสริม: {{ $detail->extra_bed_count }} เตียง</td>
                        </tr>
                        <tr>
                            <td>วันที่เวลาการเข้าพัก:</td>
                            <td>{{ \Carbon\Carbon::parse($detail->checkin_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($detail->checkout_date)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td>จำนวนคน:</td>
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
                            <td style="width: 35%;">ค่าห้องทั้งหมด:</td>
                            <td></td>
                        </tr>
                        <tr style="height: 24px;">
                            <td style="width: 35%;">ค่าเตียงเสริมทั้งหมด:</td>
                            <td></td>
                        </tr>
                        <tr style="border-top: 1px solid #ccc;">
                            <td></td>
                            <td style="text-align: right; padding-top: 0px; padding-bottom: 0px;">ยอดรวมทั้งหมด</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td style="border: 1px solid #ccc; padding: 8px; vertical-align: top;">
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
                            <td style="text-align: right;">{{ $room_cost }} บาท</td>
                        </tr>
                        <tr style="height: 24px;">
                            <td style="text-align: right;">{{ $extra_bed_cost }} บาท</td>
                        </tr>
                        <tr style="height: 24px;">
                            <td style="text-align: right;">{{ number_format($booking->total_cost, 2) }} บาท</td>
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

        <table class="table-spacing" style="margin-top: 10px; width: 100%;">
            <tr>
                <td width="50%" class="text-center">
                    (...................................................)<br>
                    ชื่อผู้รับเงิน<br>
                    <div>วันที่ {{ \Carbon\Carbon::now()->format('d/m/Y') }}</div>
                </td>
                <td width="50%" class="text-center">
                    (...................................................)<br>
                    ชื่อลูกค้า<br>
                    <div>วันที่ {{ \Carbon\Carbon::now()->format('d/m/Y') }}</div>
                </td>
            </tr>
        </table>

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