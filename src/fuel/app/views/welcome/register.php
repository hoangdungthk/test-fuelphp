<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
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
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('https://img.freepik.com/free-vector/abstract-hexagonal-white-background-design_1017-17583.jpg') no-repeat center center/cover;
        }

        .register-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
        }

        .register-container h2 {
            margin-bottom: 15px;
            color: #333;
        }

        .input-group {
            margin-bottom: 10px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .input-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .register-btn {
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .register-btn:hover {
            background: #218838;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        .login-link {
            margin-top: 10px;
            font-size: 14px;
        }

        .login-link a {
            color: #007bff;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>Đăng Ký</h2>
    <form id="registerForm">
        <div class="input-group">
            <label for="name">Họ và Tên</label>
            <input type="text" id="name" required>
        </div>
        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" required>
        </div>
        <div class="input-group">
            <label for="password">Mật khẩu</label>
            <input type="password" id="password" required>
        </div>
        <div class="input-group">
            <label for="confirm_password">Xác nhận mật khẩu</label>
            <input type="password" id="confirm_password" required>
        </div>
        <button type="submit" class="register-btn">Đăng ký</button>
        <p class="error-message" id="errorMessage"></p>
    </form>
    <p class="login-link">Đã có tài khoản? <a href="login.html">Đăng nhập</a></p>
</div>

<script>
    $(document).ready(function () {
        $("#registerForm").submit(function (event) {
            event.preventDefault();

            let name = $("#name").val();
            let email = $("#email").val();
            let password = $("#password").val();
            let confirmPassword = $("#confirm_password").val();
            let errorMessage = $("#errorMessage");

            if (password !== confirmPassword) {
                errorMessage.text("Mật khẩu không khớp!");
                return;
            }

            // Giả lập đăng ký thành công
            alert("Đăng ký thành công!");
            window.location.href = "login.html";
        });
    });
</script>

</body>
</html>
