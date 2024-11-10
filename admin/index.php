<?php

require_once '../commons/env.php';
require_once '../commons/core.php';

require_once './views/layout/header.php';
#require Controller
require_once '../admin/controllers/HomeController.php';
require_once '../admin/controllers/GiaodienController.php';
require_once '../admin/controllers/SanPhamController.php';


 #require Model
require_once '../admin/models/SanPham.php';



 $home = new HomeController();





 // Route
 $act = $_GET['act'] ?? '/';



// kiểm tra act và điều hướng tới các controller phù hợp
match ($act) {
    
    '/' => $home ->views_home(),

    //banner-noi dung
    'giao-dien'=>(new AdminGiaodienController())->listBanner(),

    // route sản phẩm
    'san-pham'=>(new SanPhamController())->danhSachSanPham(),
    'form-them-san-pham'=>(new SanPhamController())->formAddSanPham(),
    'them-san-pham'=>(new SanPhamController())->postAddSanPham(),
    // 'form-sua-san-pham'=>(new SanPhamController())->formEditSanPham(),
    // 'sua-san-pham'=>(new SanPhamController())->postEditSanPham(),
    // 'xoa-san-pham'=>(new SanPhamController())->deleteSanPham(),
};






require_once './views/layout/footer.php';