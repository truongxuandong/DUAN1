<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tài khoản</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* CSS for the registration form */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .content-header {
            background-color: #fff;
            padding: 15px;
            border-bottom: 2px solid #e2e2e2;
        }

        .content-header h2 {
            margin: 0;
        }

        .card {
            margin-top: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            padding: 10px 20px;
        }

        .card-body {
            padding: 20px;
        }

        .form-group label {
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .alert {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .alert .close {
            font-size: 1.5em;
            color: #aaa;
            cursor: pointer;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        p.text-danger {
            text-align: center;
            color: red;
        }

        .social-auth-links {
            text-align: center;
            margin-top: 15px;
        }

        .social-auth-links a {
            color: #007bff;
        }

        @media (max-width: 576px) {
            .card {
                margin: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- Content Header -->
        <section class="content-header">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>Quản lý tài khoản</h2>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="content">
            <!-- Error and Success Messages -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> <?= $_SESSION['error'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> <?= $_SESSION['success'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <form action="?act=post-register" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Họ và tên:</label>
                            <input type="text" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Mật khẩu:</label>
                            <input type="password" id="password" name="password" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Số điện thoại:</label>
                            <input type="text" id="phone" name="phone">
                        </div>

                        <div class="form-group">
                            <label for="avatar">Ảnh đại diện:</label>
                            <input type="file" id="avatar" name="avatar">
                        </div>
                        <div class="form-group">
                            <label for="role">Phân quyền:</label>
                            <select id="role" name="role" required>
                                <option value="user">Người dùng</option>
                                <option value="admin">Quản trị viên</option>
                            </select>
                        </div>

                        <input type="submit" value="Đăng ký">
                    </form>

                    <div class="social-auth-links text-center mt-3">
                        <p>Đã có tài khoản? <a href="<?= BASE_URL_ADMIN . '?act=login-admin' ?>">Đăng nhập</a></p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JS for auto-dismiss alert -->
    <script>
        setTimeout(function() {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
            });
        }, 3000); // 3000 ms = 3 seconds
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>