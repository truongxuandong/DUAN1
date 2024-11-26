<?php 

class UserController 
{
    private $modelUser;

    public function __construct() {
        $this->modelUser=new User();
    }

    public function views_user() {
        $users = $this->modelUser->getAll();
        require_once './views/user/listuser.php';
    }
    public function views_add_user() {
        
        require_once './views/user/adduser.php';
    }
    public function views_post_add_user() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Làm sạch dữ liệu đầu vào
            $name = trim($_POST['name']);
            $email = trim(strtolower($_POST['email'])); // Chuyển email về chữ thường
            $password = $_POST['password'];
            $phone = trim($_POST['phone']);
            $avatar = '../uploads/user/default.jpg'; // Đường dẫn mặc định cho avatar
    
            // Xử lý upload file (nếu có)
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
                $uploadDir = '../uploads/user/';
                $fileName = time() . '_' . basename($_FILES['avatar']['name']);
                $uploadFile = $uploadDir . $fileName;
    
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)) {
                    $avatar = $uploadFile;
                } else {
                    $_SESSION['error'] = "Không thể tải lên ảnh. Vui lòng thử lại!";
                    header('Location: ?act=add-user');
                    exit();
                }
            }
    
            // Gọi hàm thêm người dùng
            if ($this->modelUser->addUser($name, $email, $password, $phone, $avatar)) {
                $_SESSION['success'] = "Thêm người dùng thành công!";
                header('Location: ?act=user'); // Chuyển hướng đến trang danh sách người dùng
                exit();
            } else {
                // Lấy lỗi từ session và hiển thị
                $_SESSION['error'] = $_SESSION['error'] ?? "Có lỗi xảy ra khi thêm người dùng!";
                header('Location: ?act=add-user');
                exit();
            }
        }
    }
    

    public function views_edit_user() {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            $_SESSION['error'] = "ID người dùng không hợp lệ!";
            header('Location: ?act=user');
            exit();
        }
    
        $id = $_GET['id'];
        
        $taikhoan = $this->modelUser->getTaiKhoan($id);
    
       
        if (!$taikhoan) {
            $_SESSION['error'] = "Người dùng không tồn tại!";
            header('Location: ?act=user');
            exit();
        }
    
        require_once './views/user/edituser.php';
    }
    

    public function views_post_edit_user() {
        if (!isset($_POST['id']) || empty($_POST['id'])) {
            $_SESSION['error'] = "ID người dùng không hợp lệ!";
            header('Location: ?act=user');
            exit();
        }
    
        $id = $_POST['id'];
        $name = trim($_POST['name']);
        $email = trim(strtolower($_POST['email'])); // Chuyển email về chữ thường
        $phone = trim($_POST['phone']);
        
        $avatar = '../uploads/user/default.jpg';
    
        // Xử lý ảnh đại diện (avatar)
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
            $uploadDir = '../uploads/user/';
            $fileName = time() . '' . $_FILES['avatar']['name'];
            $uploadFile = $uploadDir . $fileName;
    
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)) {
                $avatar = $uploadFile;
            } else {
                $_SESSION['error'] = "Không thể tải ảnh lên. Vui lòng thử lại!";
                header('Location: ?act=edit-user&id=' . $id); // Quay lại trang chỉnh sửa
                exit();
            }
        }
    
        // Cập nhật thông tin người dùng
        if ($this->modelUser->updateuser($id, $name, $email, $phone, $avatar)) {
            $_SESSION['success'] = "Sửa người dùng thành công!";
            header('Location: ?act=user'); // Redirect về trang người dùng
        } else {
            $_SESSION['error'] = $_SESSION['error'] ?? "Có lỗi xảy ra khi sửa người dùng!";
            header('Location: ?act=edit-user&id=' . $id); // Quay lại trang chỉnh sửa
        }
        exit();
    }
    
   
     
    public function delete_user(){
        $id=$_GET['id'];
        if($this->modelUser->deleteuser($id)){
            $_SESSION['success'] = "xóa người dùng thành công!";
            header('Location:?act=user');
        } else {
            $_SESSION['error'] = "Có lỗi xảy ra khi xóa người dùng!";
        }
    }
}
?>