<?php
// Kiểm tra xem người dùng đã đăng nhập chưa
session_start();

if (!isset($_SESSION['user'])) {
    // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
    header("Location: ?act=login");
    exit();
}

$user = $_SESSION['user']; // Lấy thông tin người dùng từ session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài Khoản Của Bạn</title>
</head>
<body>
    <h1>Chào mừng, <?php echo htmlspecialchars($user['name']); ?>!</h1>
    <p>Email của bạn: <?php echo htmlspecialchars($user['email']); ?></p>
    <p>Số điện thoại: <?php echo htmlspecialchars($user['phone']); ?></p>
    
    <a href="?act=logout">Đăng xuất</a>
</body>
</html>