<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Cá Nhân</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: #f4f4f4;
            background: url('https://img.freepik.com/free-vector/abstract-hexagonal-white-background-design_1017-17583.jpg') no-repeat center center/cover;
        }

        .profile-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 80%;
            text-align: center;
        }

        .profile-container h2 {
            margin-bottom: 15px;
            color: #333;
        }

        .info-group {
            margin-bottom: 10px;
            text-align: left;
        }

        .info-group label {
            font-weight: bold;
        }

        .balance {
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
        }

        .transaction-buttons {
            display: flex;
            justify-content: flex-start; /* Đẩy nút về bên phải */
            gap: 10px; /* Tạo khoảng cách giữa hai nút */
            margin-top: 15px; /* Tạo khoảng cách với nội dung trên */
        }

        .transaction-buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        #depositBtn {
            background: #28a745; /* Xanh lá cho Nạp tiền */
            color: white;
        }

        #withdrawBtn {
            background: #dc3545; /* Đỏ cho Rút tiền */
            color: white;
        }
        .deposit-btn:hover { background: #218838; }
        .withdraw-btn:hover { background: #c82333; }

        /* Popup */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: center;
        }

        .popup input {
            width: 100%;
            padding: 8px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .popup .btn {
            margin-top: 10px;
        }

        .close-popup {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-popup:hover {
            color: red;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .balance-title {
            text-align: center;
            font-size: 1.5em;
            color: #333;
            margin-bottom: 20px;
        }

        .balance-table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        .balance-table th,
        .balance-table td {
            padding: 10px;
            border: 1px solid #ddd;
            font-size: 1.1em;
        }

        .balance-table th {
            background-color: #f4f4f4;
            color: #555;
        }

        .balance-table tbody tr {
            transition: background-color 0.3s ease;
        }

        .balance-table tbody tr.positive {
            background-color: #d4f7e0; /* Màu xanh nhạt cho số tiền dương */
        }

        .balance-table tbody tr.negative {
            background-color: #f7d4d4; /* Màu đỏ nhạt cho số tiền âm */
        }

        .balance-table tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<div class="profile-container">
    <h2>Thông Tin Cá Nhân</h2>
    <div class="info-group"><label>Họ và Tên:</label> <span id="name">Nguyễn Văn A</span></div>
    <div class="info-group"><label>Email:</label> <span id="email">nguyenvana@example.com</span></div>
    <div class="info-group"><label>Số tài khoản:</label> <span id="account">123456789</span></div>
    <div class="info-group"><label>Số dư:</label> <span class="balance" id="balance">10,000,000 VND</span></div>

    <div class="transaction-buttons">
        <button id="depositBtn">Nạp tiền</button>
        <button id="withdrawBtn">Rút tiền</button>
    </div>

<!--    <div>-->
<!--        <h2 class="balance-title">Biến động số dư</h2>-->
<!--        <table class="balance-table">-->
<!--            <thead>-->
<!--            <tr>-->
<!--                <th>Thời gian</th>-->
<!--                <th>Số tiền</th>-->
<!--                <th>Ghi chú</th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody id="balanceHistory">-->
<!--            <!-- Các dòng dữ liệu sẽ được thêm qua JavaScript -->
<!--            </tbody>-->
<!--        </table>-->
<!--    </div>-->

    <div>
        <h2 class="balance-title">Biến động số dư</h2>
        <table class="balance-table">
            <thead>
            <tr>
                <th>Thời gian</th>
                <th>Số tiền</th>
                <th>Ghi chú</th>
            </tr>
            </thead>
            <tbody id="balanceHistory">
            <!-- Các dòng dữ liệu sẽ được thêm qua JavaScript -->
            </tbody>
        </table>
    </div>


    <!-- Popup -->
<div class="overlay"></div>
<div class="popup" id="transactionPopup">
    <span class="close-popup">&times;</span> <!-- Nút đóng -->
    <h3 id="popupTitle"></h3>
    <input type="number" id="amount" placeholder="Nhập số tiền">
    <input type="text" id="note" placeholder="Ghi chú">
    <button class="btn deposit-btn" id="confirmTransaction">Xác nhận</button>
</div>

<script>
    $(document).ready(function () {
        let transactionType = "";
        $("#depositBtn, #withdrawBtn").click(function () {
            transactionType = $(this).attr("id") === "depositBtn" ? "Nạp tiền" : "Rút tiền";
            $("#popupTitle").text(transactionType);
            $(".overlay, #transactionPopup").fadeIn();
        });

        $(".overlay, .close-popup").click(function () {
            $(".overlay, #transactionPopup").fadeOut();
        });

    //     // Sử dụng jQuery để lấy dữ liệu từ API
    //     $.ajax({
    //         url: 'https://api.example.com/balance-history',  // Đường dẫn API của bạn
    //         method: 'GET',
    //         success: function(data) {
    //             // Duyệt qua dữ liệu và thêm vào bảng
    //             const tableBody = $('#balanceHistory');
    //             data.forEach(item => {
    //                 const row = $('<tr></tr>');  // Tạo một hàng mới
    //                 const timeCell = $('<td></td>').text(item.time);
    //                 const amountCell = $('<td></td>').text(item.amount);
    //                 const noteCell = $('<td></td>').text(item.note);
    //
    //                 // Xác định màu nền của hàng dựa trên số tiền (+ hoặc -)
    //                 if (item.amount > 0) {
    //                     row.addClass('positive');
    //                 } else if (item.amount < 0) {
    //                     row.addClass('negative');
    //                 }
    //
    //                 row.append(timeCell, amountCell, noteCell);
    //                 tableBody.append(row);  // Thêm hàng vào bảng
    //             });
    //         },
    //         error: function(error) {
    //             console.error('Có lỗi khi lấy dữ liệu:', error);
    //         }
    //     });
    });

    document.addEventListener("DOMContentLoaded", function() {
        // Dữ liệu ngẫu nhiên mẫu
        const balanceData = [
            { time: '2025-02-01 12:00', amount: 150000, note: 'Nạp tiền' },
            { time: '2025-02-02 14:00', amount: -50000, note: 'Rút tiền' },
            { time: '2025-02-03 16:00', amount: 100000, note: 'Nạp tiền' },
            { time: '2025-02-04 18:00', amount: -20000, note: 'Rút tiền' },
            { time: '2025-02-05 10:00', amount: 80000, note: 'Nạp tiền' }
        ];

        const tableBody = document.getElementById('balanceHistory');

        // Duyệt qua dữ liệu và thêm vào bảng
        balanceData.forEach(item => {
            const row = document.createElement('tr');
            const timeCell = document.createElement('td');
            const amountCell = document.createElement('td');
            const noteCell = document.createElement('td');

            timeCell.textContent = item.time;
            noteCell.textContent = item.note;
            amountCell.textContent = item.amount;

            // Xác định màu nền của hàng dựa trên số tiền (+ hoặc -)
            if (item.amount > 0) {
                row.classList.add('positive');
            } else if (item.amount < 0) {
                row.classList.add('negative');
            }

            row.appendChild(timeCell);
            row.appendChild(amountCell);
            row.appendChild(noteCell);
            tableBody.appendChild(row);
        });
    });

</script>

</body>
</html>
