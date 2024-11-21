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
            $avatar = '../uploads/user/default.jpg';
            $name = $_POST['name'];
            $email = $_POST['email']; 
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            // mã hóa mk
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);   
            if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
                $uploadDir = '../uploads/user/';
                $fileName = time() . '' . $_FILES['avatar']['name'];
                $uploadFile = $uploadDir . $fileName;
    
                if(move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)) {
                    $avatar = $uploadFile;
                } else {
                    $_SESSION['error'] = "Không thể tải lên ảnh. Vui lòng thử lại!";
                }
            }
           $_POST['avatar'] = $avatar;

           
    
        }
        if($this->modelUser->adduser($name,$email,$hashedPassword,$phone,$avatar)) {
            $_SESSION['success'] = "Thêm người dùng thành công!";
            header('Location:?act=user');
        } else {
            $_SESSION['error'] = "Có lỗi xảy ra khi thêm người dùng!";
        }
        
    }

    public function views_edit_user() {
        $id = $_GET['id'];
        $taikhoan=$this->modelUser->getTaiKhoan($id);
        require_once './views/user/edituser.php';
    }

    public function views_post_edit_user() {
        $id=$_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email']; 
        $phone = $_POST['phone'];
        $role = $_POST['role']; // Lấy giá trị role từ form
        $avatar = '../uploads/user/default.jpg';

        if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
            $uploadDir = '../uploads/user/';
            $fileName = time() . '' . $_FILES['avatar']['name'];
            $uploadFile = $uploadDir . $fileName;

            if(move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)) {
                $avatar = $uploadFile;
            } 
        }
        if($this->modelUser->updateuser($id,$name,$email,$phone,$avatar,$role)) {
            $_SESSION['success'] = "Sửa người dùng thành công!";
            header('Location:?act=user');
        } else {
            $_SESSION['error'] = "Có lỗi xảy ra khi sửa người dùng!";
        }
        
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