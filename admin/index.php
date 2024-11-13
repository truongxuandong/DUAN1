<?php
session_start();

require_once '../commons/env.php';
require_once '../commons/core.php';

require_once './views/layout/header.php';
require_once './views/layout/sidebar.php';

#require Controller
require_once './controllers/HomeController.php';

require_once './controllers/OrderController.php';
require_once './controllers/UserController.php';
require_once './controllers/GiaodienController.php';
require_once './controllers/SanPhamController.php';
require_once './controllers/DanhMucController.php';






 #require Model
require_once './models/User.php';
require_once './models/Order.php';

require_once './models/DanhMuc.php';
require_once './models/SanPham.php';


 $home = new HomeController();
 $user = new userController();
 $order = new OrderController();






// Route
$act = $_GET['act'] ?? '/';

// function checkLoginAdmin()
// {
//     if (!isset($_SESSION['admin_logged_in'])) {
//         header('Location: login.php'); // Redirect to login page
//         exit();
//     }
// }


// kiểm tra act và điều hướng tới các controller phù hợp
match ($act) {


    //home
    '/' => $home->views_home(),



    //user
    'user' => $user ->views_user(),
    'add-user' => $user ->views_add_user(),
    'post-add-user' => $user ->views_post_add_user(),
    'edit-user' => $user ->views_edit_user(),
    'post-edit-user' => $user ->views_post_edit_user(),
    'delete-user' => $user ->delete_user(),
    //order
    'order' => $order ->views_order(),
    'delete-order' => $order ->deleteorder(),
    'edit-order' => $order ->views_edit_order(),
    'post-edit-order' => $order ->views_post_edit_order(),
    'order-detail' => $order ->views_order_detail(),

     //banner-noi dung
     'giao-dien'=>(new AdminGiaodienController())->listBanner(),
    

    // rou danh mục
    'listdm' => (new DanhMucController())->danhsachDanhMuc(),
    'form-them-danh-muc' => (new DanhMucController())->formAddDanhMuc(),
    'post-danh-muc' => (new DanhMucController())->postAddDanhMuc(),
    'form-sua-danh-muc' => (new DanhMucController())->formEditDanhMuc(),
    'sua-danh-muc' => (new DanhMucController())->postEditDanhMuc(),
    'xoa-danh-muc' => (new DanhMucController())->deleteDanhMuc(),
    //route san pham
    'san-pham' => (new SanPhamController())->danhSachSanPham(),
    'form-them-san-pham' => (new SanPhamController())->formAddSanPham(),
    'them-san-pham' => (new SanPhamController())->postAddSanPham(),
    'form-sua-san-pham' => (new SanPhamController())->formEditSanPham(),
    'sua-san-pham' => (new SanPhamController())->postEditSanPham(),
    'xoa-san-pham' => (new SanPhamController())->postDeleteSanPham(),




    //route login
    // 'login-admin' => (new UserController())->formlogin(),
    // 'check-login-admin' => (new UserController())->login(),
    // 'logout-admin' => (new UserController())->logout(),
    // 'register' => (new UserController())->formdangky(),
    // 'post-register' => (new UserController())->views_post_register(),

};
require_once './views/layout/footer.php';
