<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
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

        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 320px;
            text-align: center;
        }

        .login-container h2 {
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

        .login-btn {
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .login-btn:hover {
            background: #0056b3;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Đăng Nhập</h2>
    <form id="loginForm">
        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" required>
        </div>
        <div class="input-group">
            <label for="password">Mật khẩu</label>
            <input type="password" id="password" required>
        </div>
        <button type="submit" class="login-btn">Đăng nhập</button>
        <p class="error-message" id="errorMessage"></p>
    </form>
    <p class="register-link">Chưa có tài khoản? <a href="register.html">Đăng ký</a></p>
</div>

<script>
    $(document).ready(function () {
        $("#loginForm").submit(function (event) {
            event.preventDefault(); // Ngăn form load lại trang

            let email = $("#email").val();
            let password = $("#password").val();
            let errorMessage = $("#errorMessage");

            if (email === "admin@example.com" && password === "123456") {
                alert("Đăng nhập thành công!");
            } else {
                errorMessage.text("Sai email hoặc mật khẩu!");
            }
        });
    });
</script>

</body>
</html>
