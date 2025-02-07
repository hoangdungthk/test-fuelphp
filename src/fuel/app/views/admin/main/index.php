<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý User</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        table {
            background: #fff;
        }
        .modal-content {
            border-radius: 10px;
        }

        .password-column {
            min-width: 300px; /* Điều chỉnh kích thước phù hợp */
            max-width: 400px; /* Đảm bảo không bị quá rộng */
            white-space: nowrap;
        }

        .password-full {
            display: inline-block;
            width: auto; /* Hiển thị đầy đủ nội dung */
            overflow: visible;
            text-overflow: clip; /* Không cắt chữ */
            vertical-align: middle;
        }

        .toggle-password {
            margin-left: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Quản lý User</h2>

    <!-- Thông báo -->
    <div id="alert-container"></div>

    <!-- Bảng danh sách user -->
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody id="user-table-body">
                <!-- Dữ liệu sẽ được render bằng JS -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Popup Sửa User -->
<div id="editUserModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Chỉnh sửa User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="editUserError" class="alert alert-danger d-none"></div>
                <form id="editUserForm">
                    <input type="hidden" id="editUserId">
                    <div class="mb-3">
                        <label for="editUserName" class="form-label">Tên</label>
                        <input type="text" class="form-control" id="editUserName" required minlength="6" maxlength="50">
                    </div>
                    <div class="mb-3">
                        <label for="editUserPassword" class="form-label">Mật khẩu (để trống nếu không đổi)</label>
                        <input type="password" class="form-control" id="editUserPassword" minlength="6" maxlength="50">
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Popup Xác nhận Xóa -->
<div class="modal fade" id="deleteUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="delete-user-message"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-danger" id="confirm-delete">Xóa</button>
            </div>
        </div>
    </div>
</div>

<!-- File JS -->
<script src="/assets/js/admin_user.js"></script>

</body>
</html>
