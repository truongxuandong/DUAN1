<?php
class AccountController
{
    private $pdo;

    // Khởi tạo với kết nối CSDL
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Phương thức hiển thị thông tin tài khoản
    public function profile()
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user'])) {
            header("Location: ?act=login");
            exit();
        }

        // Lấy thông tin người dùng từ session
        $user = $_SESSION['user'];

        // Gọi view để hiển thị trang profile
        require_once 'clients/views/account/thongtin.php';
    }

    // Phương thức sửa hồ sơ
    public function editProfile()
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user'])) {
            header("Location: ?act=login");
            exit();
        }

        // Nếu gửi form sửa hồ sơ
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy thông tin từ form
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? ''; // Lấy số điện thoại
            $avatar = $_FILES['avatar'] ?? null;

            // Cập nhật thông tin người dùng trong session
            $_SESSION['user']['name'] = $name;
            $_SESSION['user']['email'] = $email;
            $_SESSION['user']['phone'] = $phone; // Lưu số điện thoại vào session

            // Nếu có ảnh đại diện, xử lý upload (nếu cần)
            if ($avatar) {
                // Xử lý upload ảnh ở đây
            }

            // Chuyển hướng về trang profile
            header("Location: ?act=don-hang");
            exit();
        }

        // Lấy thông tin người dùng từ session
        $user = $_SESSION['user'];

        // Gọi view sửa hồ sơ
        require_once 'clients/views/account/edit-profile.php';
    }

    // Phương thức đổi mật khẩu
    public function changePassword()
{
    // Kiểm tra người dùng đã đăng nhập chưa
    if (!isset($_SESSION['user'])) {
        header("Location: ?act=login");
        exit();
    }

    // Lấy ID người dùng từ session
    $userId = $_SESSION['user']['id'];

    // Nếu gửi form đổi mật khẩu
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lấy thông tin từ form
        $currentPassword = $_POST['current-password'] ?? '';
        $newPassword = $_POST['new-password'] ?? '';
        $confirmPassword = $_POST['confirm-password'] ?? '';

        // Khởi tạo đối tượng User với kết nối CSDL
        $user = new User($_SESSION['user'], $this->pdo);

        // Kiểm tra mật khẩu hiện tại
        $currentPasswordHash = $user->getPassword($userId);

        if (!password_verify($currentPassword, $currentPasswordHash)) {
            $_SESSION['error'] = "Mật khẩu hiện tại không đúng.";
            require_once 'clients/views/account/change-password.php';
            return;
        }

        // Kiểm tra mật khẩu mới và xác nhận mật khẩu có khớp không
        if ($newPassword !== $confirmPassword) {
            $_SESSION['error'] = "Mật khẩu mới và xác nhận mật khẩu không khớp.";
            require_once 'clients/views/account/change-password.php';
            return;
        }

        // Cập nhật mật khẩu mới vào cơ sở dữ liệu
        $user->updatePassword($userId, $newPassword);

        // Cập nhật mật khẩu mới vào session (nếu cần)
        $_SESSION['user']['password'] = $newPassword;

        // Thiết lập thông báo thành công vào session
        $_SESSION['success'] = "Mật khẩu đã được thay đổi thành công.";

        // Chuyển hướng về trang profile
        header("Location: ?act=change-password");
        exit();
    }

    // Gọi view để hiển thị form đổi mật khẩu
    require_once 'clients/views/account/change-password.php';
}

    
}
