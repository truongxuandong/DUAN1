<?php
session_start();

require_once '../commons/env.php';
require_once '../commons/core.php';

require_once './views/layout/header.php';
require_once './views/layout/sidebar.php';

#require Controller
require_once './controllers/HomeController.php';
require_once './controllers/GiaodienController.php';
require_once './controllers/SanPhamController.php';
require_once './controllers/DanhMucController.php';
require_once './controllers/UserController.php';





 #require Model
require_once './models/User.php';
require_once './models/DanhMuc.php';
require_once './models/SanPham.php';


 $home = new HomeController();
 $user = new userController();
 






// Route
$act = $_GET['act'] ?? '/';



// kiểm tra act và điều hướng tới các controller phù hợp
match ($act) {


    //home
    '/' => $home->views_home(),

    //banner-noi dung
    'giao-dien'=>(new AdminGiaodienController())->listBanner(),
    // rou danh mục
    'listdm' => (new DanhMucController())->danhsachDanhMuc(),
    'form-them-danh-muc' => (new DanhMucController())->formAddDanhMuc(),
    'post-danh-muc' => (new DanhMucController())->postAddDanhMuc(),
    'form-sua-danh-muc' => (new DanhMucController())->formEditDanhMuc(),
    'sua-danh-muc' => (new DanhMucController())->postEditDanhMuc(),
    'xoa-danh-muc' => (new DanhMucController())->deleteDanhMuc(),
    // rou sản phẩm
    'san-pham'=>(new SanPhamController())->danhSachSanPham(),
    'form-them-san-pham'=>(new SanPhamController())->formAddSanPham(),
    'them-san-pham'=>(new SanPhamController())->postAddSanPham(),
    'form-sua-san-pham'=>(new SanPhamController())->formEditSanPham(),
    'sua-san-pham'=>(new SanPhamController())->postEditSanPham(),
    'xoa-san-pham'=>(new SanPhamController())->postDeleteSanPham(),

};





require_once './views/layout/footer.php';
