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
        <p class="error-message" id="errorMessage"></p>
        <p class="login-link">Đã có tài khoản? <a href="login">Đăng nhập</a></p>
        <div class="input-group">
            <label for="username">Tên tài khoản</label>
            <input type="text" id="username" required>
        </div>
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
    </form>
</div>

<script>
    $(document).ready(function () {
        const API_REGISTER = "/api/auth/register";
        $("#registerForm").submit(function (event) {
            event.preventDefault();

            let username = $("#username").val();
            let name = $("#name").val();
            let email = $("#email").val();
            let password = $("#password").val();
            let confirmPassword = $("#confirm_password").val();
            let errorMessage = $("#errorMessage");

            // Reset error message
            errorMessage.text("");

            // Kiểm tra độ dài username (6-50 ký tự)
            if (username.length < 6 || username.length > 50) {
                errorMessage.text("Tên tài khoản phải từ 6 đến 50 ký tự!");
                return;
            }

            // Kiểm tra độ dài name (6-50 ký tự)
            if (name.length < 6 || name.length > 50) {
                errorMessage.text("Họ và tên phải từ 6 đến 50 ký tự!");
                return;
            }

            // Kiểm tra độ dài password (6-50 ký tự)
            if (password.length < 6 || password.length > 50) {
                errorMessage.text("Mật khẩu phải từ 6 đến 50 ký tự!");
                return;
            }

            // Kiểm tra định dạng email
            let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                errorMessage.text("Email không hợp lệ!");
                return;
            }

            // Kiểm tra mật khẩu có khớp không
            if (password !== confirmPassword) {
                errorMessage.text("Mật khẩu không khớp!");
                return;
            }

            $.ajax({
                url: API_REGISTER,
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    username: username,
                    name: name,
                    email: email,
                    password: password,
                }),
                success: function (response) {
                    alert("Đăng ký thành công!");
                    window.location.href = "/login";
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                    errorMessage.text('Đăng ký thất bại')
                }
            })
        });
    });
</script>

</body>
</html>
