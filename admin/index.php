<?php
session_start();

require_once '../commons/env.php';
require_once '../commons/core.php';

require_once './views/layout/header.php';
require_once './views/layout/sidebar.php';

#require Controller
require_once '../admin/controllers/HomeController.php';
require_once '../admin/controllers/GiaodienController.php';
require_once '../admin/controllers/BinhluanController.php';
require_once './controllers/HomeController.php';

require_once './controllers/OrderController.php';
require_once './controllers/UserController.php';
require_once './controllers/GiaodienController.php';
require_once './controllers/SanPhamController.php';
require_once './controllers/DanhMucController.php';
require_once './controllers/KhuyenMaiController.php';






 #require Model
require_once './models/User.php';
require_once './models/Order.php';
require_once './models/VariantSanPham.php';
require_once './models/DanhMuc.php';
require_once './models/SanPham.php';
require_once './models/KhuyenMai.php';
require_once './models/AdminBinhluan.php';
require_once './models/AdminBanner.php';


 $home = new HomeController();
 $user = new userController();
 $order = new OrderController();
 $khuyenmai = new KhuyenMaiController();





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

     //banner
    'giao-dien'=>(new AdminGiaodienController())->listBanner(),
    'form-add-banner'=>(new AdminGiaodienController())->formaddBanner(),
    'add-banner'=>(new AdminGiaodienController())->postaddBanner(),
    'toggle-banner-status'=>(new AdminGiaodienController())->UpdataBannerStatus(),
    'delete-banner'=>(new AdminGiaodienController())->deleteBanner(),
    'form-edit-banner'=>(new AdminGiaodienController())->formEditBanner(),
    'edit-banner'=>(new AdminGiaodienController())->postEditBanner(),
    
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



    //khuyen mai
    'khuyen-mai' => $khuyenmai->View_KhuyenMai(),
    'form-add-khuyen-mai' => $khuyenmai->formAddKhuyenMai(),
    'post-add-khuyen-mai' => $khuyenmai->postAddKhuyenMai(),
    'form-edit-khuyen-mai' => $khuyenmai->formEditKhuyenMai(),
    'post-edit-khuyen-mai' => $khuyenmai->postEditKhuyenMai(),
    'delete-khuyen-mai' => $khuyenmai->deleteKhuyenMai(),






  
    //rou bien the sp
    'chi-tiet-bien-the-sp' => (new SanPhamController())->danhSachVariants(),
    'form-them-bien-the' => (new SanPhamController())->formAddVariant(),
    'them-bien-the' => (new SanPhamController())->postAddVariant(),
    'form-sua-bien-the' => (new SanPhamController())->formEditVariant(),
    'sua-bien-the' => (new SanPhamController())->postEditVariant(),
    'xoa-bien-the' => (new SanPhamController())->postDeleteVariant(),
  
    //binh luan
    'binh-luan'=>(new AdminBinhluanController())->listBinhluan(),
    'update-trang-thai-binh-luan'=>(new AdminBinhluanController())->updateTrangThaiBinhLuan(),
    'danh-gia'=>(new AdminBinhluanController())->listDanhgia(),
    'delete-danhgia'=>(new AdminBinhluanController())->deletedanhgia(),
    'approve-danhgia'=>(new AdminBinhluanController())->approveDanhGia(),
    'reject-danhgia'=>(new AdminBinhluanController())->rejectDanhGia(),
  

    //route login
    // 'login-admin' => (new UserController())->formlogin(),
    // 'check-login-admin' => (new UserController())->login(),
    // 'logout-admin' => (new UserController())->logout(),
    // 'register' => (new UserController())->formdangky(),
    // 'post-register' => (new UserController())->views_post_register(),

};
require_once './views/layout/footer.php';
?>