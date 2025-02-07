$(document).ready(function () {
    const API_GET_USERS = "/admin/api/user/index";
    const API_DELETE_USER = "/admin/api/user/destroy/";
    const API_UPDATE_USER = "/admin/api/user/update/";

    function loadUsers() {
        $.get(API_GET_USERS, function (response) {
            if (response.status === "success") {
                renderUsers(response.data);
            } else {
                showError("Không thể tải danh sách user.");
            }
        }).fail(function (xhr) {
            console.log(xhr.responseText);
            showError("Lỗi kết nối đến API.");
        });
    }

    function renderUsers(users) {
        let tbody = $("#user-table-body");
        tbody.empty();

        users.forEach(function (user) {
            let row = `
                <tr>
                    <td>${user.id}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td class="password-column">
                        <span class="password-hidden">******</span>
                        <span class="password-full d-none">${user.password}</span>
                        <button class="btn btn-sm btn-outline-secondary toggle-password">👁</button>
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-user" 
                            data-id="${user.id}" 
                            data-name="${user.name}">Sửa</button>
                        <button class="btn btn-danger btn-sm delete-user" 
                            data-id="${user.id}" 
                            data-email="${user.email}">Xóa</button>
                    </td>
                </tr>
            `;
            tbody.append(row);
        });
    }

    // Hiện/ẩn mật khẩu
    $(document).on("click", ".toggle-password", function () {
        let row = $(this).closest("td");
        row.find(".password-hidden, .password-full").toggleClass("d-none");
    });

    // Mở popup sửa user
    $(document).on("click", ".edit-user", function () {
        let userId = $(this).data("id");
        let userName = $(this).data("name");

        $("#editUserId").val(userId);
        $("#editUserName").val(userName); // Giữ nguyên tên cũ
        $("#editUserPassword").val(""); // Reset mật khẩu mỗi lần mở modal

        $("#editUserModal").modal("show");
    });

    // Xử lý submit form sửa user
    $("#editUserForm").submit(function (event) {
        event.preventDefault(); // ❌ Ngăn chặn reload trang

        let userId = $("#editUserId").val();
        let userName = $("#editUserName").val().trim();
        let userPassword = $("#editUserPassword").val().trim();
        let errorBox = $("#editUserError");

        // Ẩn thông báo lỗi nếu dữ liệu hợp lệ
        errorBox.addClass("d-none");

        let requestData = { name: userName };
        if (userPassword !== "") {
            requestData.password = userPassword;
        }

        $.ajax({
            url: API_UPDATE_USER + userId,
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(requestData),
            success: function (response) {
                if (response.status === "success") {
                    $("#editUserModal").modal("hide");
                    showSuccess("User đã được cập nhật.");
                    loadUsers();
                } else {
                    showError("Cập nhật thất bại, vui lòng thử lại.");
                }
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                showError("Không thể cập nhật user.");
            }
        });
    });

    // Mở popup xác nhận xóa user
    $(document).on("click", ".delete-user", function () {
        let userId = $(this).data("id");
        let userEmail = $(this).data("email");

        $("#delete-user-message").text(`Bạn có chắc chắn muốn xóa user "${userEmail}"?`);
        $("#confirm-delete").data("id", userId);
        $("#deleteUserModal").modal("show");
    });

    // Xác nhận xóa user
    $("#confirm-delete").click(function () {
        let userId = $(this).data("id");

        $.ajax({
            url: API_DELETE_USER + userId,
            type: "POST",
            success: function () {
                $("#deleteUserModal").modal("hide");
                showSuccess("User đã bị xóa.");
                loadUsers(); // Load lại danh sách user sau khi xóa
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                showError("Không thể xóa user.");
            }
        });
    });

    function showSuccess(message) {
        $("#alert-container").html(`
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `);
    }

    function showError(message) {
        $("#alert-container").html(`
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `);
    }

    loadUsers();
});
