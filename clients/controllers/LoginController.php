<?php



class LoginController
{
    private $loginModel;

    public function __construct()
    {
        $this->loginModel = new Login();
    }

    public function login()
    {
        // session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            // Gọi phương thức checkLogin từ Model
            if ($this->loginModel->checkLogin($email, $password)) {
                $_SESSION['success'] = "Đăng nhập thành công!";
                header("Location: ?act=san-pham");  // Chuyển hướng sau khi đăng nhập thành công
                exit();
            } else {
                $_SESSION['error'] = "Email hoặc mật khẩu không đúng.";
                header("Location: ?act=login");
                exit();
            }
        }
        require_once './views/formDangky/login.php'; // Hiển thị form đăng nhập
    }


    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $phone = $_POST['phone'];

            // Kiểm tra độ dài mật khẩu
            if (strlen($password) < 6) {
                $_SESSION['error'] = "Mật khẩu phải có ít nhất 6 ký tự.";
                header("Location: ?act=register");
                exit();
            }

            // Gọi phương thức createUser từ Model
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            if ($this->loginModel->createUser($name, $email, $hashedPassword, $phone)) {
                $_SESSION['success'] = "Đăng ký thành công!";
                header("Location: ?act=login");
                exit();
            } else {
                // Lỗi do email trùng lặp hoặc vấn đề khác
                header("Location:?act=register");
                exit();
            }
        }
        require_once './views/formDangky/register.php';
    }

    public function logout()
    {
        // session_start();
        session_destroy(); // Hủy session để người dùng bị đăng xuất
        header("Location: ?act=login"); // Chuyển hướng người dùng về trang đăng nhập
        exit();
    }
}
