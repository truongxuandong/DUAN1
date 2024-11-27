<?php



class LoginController
{
    private $loginModel;

    public function __construct()
    {
        $this->loginModel = new Login();
    }

    // public function login()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $email = trim($_POST['email']);
    //         $password = $_POST['password'];

    //         // Gọi phương thức checkLogin từ Model
    //         $user = $this->loginModel->checkLogin($email, $password); // Trả về thông tin người dùng

    //         if ($user && is_array($user)) { // Kiểm tra xem có trả về mảng hay không
    //             // Lưu đầy đủ thông tin người dùng vào session
    //             $_SESSION['user'] = [
    //                 'id' => $user['id'],
    //                 'name' => $user['name'],
    //                 'email' => $user['email'],  // Thêm email
    //                 'role' => $user['role'],    // Thêm vai trò (admin hoặc user)
    //             ];

    //             $_SESSION['success'] = "Đăng nhập thành công!";

    //             // Chuyển hướng đến trang admin nếu vai trò là admin
    //             if ($user['role'] === 'admin') {
    //                 header("Location: http://localhost/duan1/admin/"); // Cập nhật đường dẫn phù hợp
    //             } else {
    //                 // Chuyển hướng đến trang chính nếu không phải admin
    //                 header("Location: ?act=/");
    //             }
    //             exit();
    //         } else {
    //             $_SESSION['error'] = "Email hoặc mật khẩu không đúng.";
    //             header("Location: ?act=login");
    //             exit();
    //         }
    //     }
    //     require_once 'clients/views/formDangky/login.php'; // Hiển thị form đăng nhập
    // }
    public function login()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        // Gọi phương thức checkLogin từ Model
        $user = $this->loginModel->checkLogin($email, $password);

        if ($user && is_array($user)) {
            // Lưu đầy đủ thông tin người dùng vào session
            $_SESSION['user'] = [
                'id' => $user['id'],          
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
            ];
            $_SESSION['user_id'] = $user['id']; 

            $_SESSION['success'] = "Đăng nhập thành công!";
            header("Location: ?act=/&user_id=" . $user['id']);
            exit();
        }
    }
    require_once 'clients/views/formDangky/login.php';
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
            if ($this->loginModel->createUser($name, $email, $password, $phone)) {
                $_SESSION['success'] = "Đăng ký thành công!";
                header("Location: ?act=login");
                exit();
            } else {
                header("Location: ?act=register");
                exit();
            }
        }
        require_once 'clients/views/formDangky/register.php';
    }

    public function logout()
    {
        // session_start();
        session_destroy(); // Hủy session để người dùng bị đăng xuất
        header("Location: ?act=/"); // Chuyển hướng người dùng về trang đăng nhập
        exit();
    }
}
