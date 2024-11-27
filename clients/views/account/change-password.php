<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="clients/clients/assets/css/thongtin.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-4">


        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 mb-4 mb-md-0">
                <div class="list-group">
                    <div class="profile-section p-3 border-bottom text-center">
                        <!-- Avatar và tên người dùng -->
                        <img src=".clients/uploads/user/default.jpg" alt="Avatar" class="rounded-circle" style="width: 60px; height: 60px;">
                        <h5 class="fw-bold mt-2">
                            <?php
                            if (isset($_SESSION['user']['name'])) {
                                echo htmlspecialchars($_SESSION['user']['name']);
                            } else {
                                echo 'Người dùng';
                            }
                            ?>
                        </h5>
                        <p><a href="?act=edit-profile" class="text-decoration-none fw-bold">Sửa Hồ Sơ</a></p>
                    </div>
                    <a href="#orders" class="list-group-item list-group-item-action" onclick="showSection('orders')">Đơn hàng của tôi</a>
                    <a href="?act=change-password" class="list-group-item list-group-item-action" onclick="showSection('change-password')">Đổi mật khẩu</a>
                </div>
            </div>
            <div class="col-md-9">
                <!-- Thông báo lỗi -->
                <?php if (isset($_SESSION['error'])): ?>
                    <div id="error-message" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa fa-exclamation-circle"></i> <?= $_SESSION['error'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <!-- Thông báo thành công -->
                <?php if (isset($_SESSION['success'])): ?>
                    <div id="success-message" class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa fa-check-circle"></i> <?= $_SESSION['success'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>
                <!-- Change Password Section -->
                <section id="change-password" class="p-4 border rounded mb-4">
                    <h2 class="h5 fw-bold">Đổi mật khẩu</h2>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="current-password" class="form-label">Mật khẩu hiện tại</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="current-password" name="current-password" required>
                                <button type="button" class="btn btn-outline-secondary" id="toggle-current-password" onclick="togglePassword('current-password')">
                                    <i class="fas fa-eye" id="current-password-icon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="new-password" class="form-label">Mật khẩu mới</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="new-password" name="new-password" required>
                                <button type="button" class="btn btn-outline-secondary" id="toggle-new-password" onclick="togglePassword('new-password')">
                                    <i class="fas fa-eye" id="new-password-icon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="confirm-password" class="form-label">Xác nhận mật khẩu mới</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                                <button type="button" class="btn btn-outline-secondary" id="toggle-confirm-password" onclick="togglePassword('confirm-password')">
                                    <i class="fas fa-eye" id="confirm-password-icon"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                    </form>
                </section>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword(id) {
            var passwordField = document.getElementById(id);
            var icon = document.getElementById(id + '-icon');

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>

</html>