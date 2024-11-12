<?php
ob_start();
class UserController
{
    private $modelUser;

    public function __construct()
    {
        $this->modelUser = new User();
    }

    public function views_user()
    {
        $users = $this->modelUser->getAll();
        require_once './views/user/listuser.php';
    }
    public function views_add_user()
    {

        require_once './views/user/adduser.php';
    }
    public function views_post_add_user()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $avatar = '../uploads/user/default.jpg';
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            // mã hóa mk
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
                $uploadDir = '../uploads/user/';
                $fileName = time() . '' . $_FILES['avatar']['name'];
                $uploadFile = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)) {
                    $avatar = $uploadFile;
                } else {
                    $_SESSION['error'] = "Không thể tải lên ảnh. Vui lòng thử lại!";
                }
            }
            $_POST['avatar'] = $avatar;
        }
        if ($this->modelUser->adduser($name, $email, $hashedPassword, $phone, $avatar)) {
            $_SESSION['success'] = "Thêm người dùng thành công!";
            header('Location:?act=user');
        } else {
            $_SESSION['error'] = "Có lỗi xảy ra khi thêm người dùng!";
        }
    }

    public function views_edit_user()
    {
        $id = $_GET['id'];
        $taikhoan = $this->modelUser->getTaiKhoan($id);
        require_once './views/user/edituser.php';
    }

    public function views_post_edit_user()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $avatar = '../uploads/user/default.jpg';

        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
            $uploadDir = '../uploads/user/';
            $fileName = time() . '' . $_FILES['avatar']['name'];
            $uploadFile = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)) {
                $avatar = $uploadFile;
            }
        }
        if ($this->modelUser->updateuser($id, $name, $email, $phone, $avatar)) {
            $_SESSION['success'] = "Sửa người dùng thành công!";
            header('Location:?act=user');
        } else {
            $_SESSION['error'] = "Có lỗi xảy ra khi sửa người dùng!";
        }
    }
    public function views_order()
    {

        require_once './views/order/listdonhang.php';
    }

    public function delete_user()
    {
        $id = $_GET['id'];
        if ($this->modelUser->deleteuser($id)) {
            $_SESSION['success'] = "xóa người dùng thành công!";
            header('Location:?act=user');
        } else {
            $_SESSION['error'] = "Có lỗi xảy ra khi xóa người dùng!";
        }
    }
    public function formlogin()
    {
        require_once './views/formDangky/login.php';
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get email and password from the form
            $email = $_POST["email"];
            $password = $_POST["password"];

            // Check login credentials
            $user = $this->modelUser->checklogin($email, $password);

            // Check if the user exists and verify the hashed password
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_admin'] = $user; // Store the user in the session
                header('Location: ' . BASE_URL_ADMIN); // Redirect to admin dashboard
                exit();
            } else {
                $_SESSION['error'] = "Invalid login credentials";
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=login-admin'); // Redirect back to login page
                exit();
            }
        }
    }



    public function logout()
    {
        if (isset($_SESSION['user_admin'])) {
            unset($_SESSION['user_admin']);
            header("Location: " . BASE_URL_ADMIN . '?act=login-admin');
        }
    }
    public function formdangky()
    {
        require_once './views/formDangky/register.php';
    }

    // Xử lý đăng ký người dùng
    public function views_post_register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];  // No password hashing
            $phone = $_POST['phone'];
            $avatar = '../uploads/user/default.jpg';

            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
                $uploadDir = '../uploads/user/';
                $fileName = time() . '_' . $_FILES['avatar']['name'];
                $uploadFile = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)) {
                    $avatar = $uploadFile;
                } else {
                    $_SESSION['error'] = "Không thể tải lên ảnh. Vui lòng thử lại!";
                }
            }

            // Gọi hàm thêm người dùng vào cơ sở dữ liệu (without hashing password)
            if ($this->modelUser->registerUser($name, $email, $password, $phone, $avatar)) {
                $_SESSION['success'] = "Đăng kí thành công! Bạn có thể đăng nhập.";
                header("Location: " . BASE_URL_ADMIN . '?act=login-admin');
                exit();
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra khi đăng kí. Vui lòng thử lại!";
                header("Location: " . BASE_URL_ADMIN . '?act=register');
                exit();
            }
        }
    }
}
ob_end_flush();
