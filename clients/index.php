<?php
// Start the session
session_start();
require_once '../commons/core.php';
require_once '../commons/env.php';
require_once './views/layout/header.php';

#require Controller
require_once '../clients/controllers/HomeController.php';
require_once '../clients/controllers/LoginController.php';

#require Model
require_once '../clients/models/Cart.php';
require_once '../clients/models/Login.php';
require_once './models/danhmuc.php';
require_once './models/sanpham.php';

// Instantiate the HomeController
$home = new HomeController();

// Route
$act = $_GET['act'] ?? '/';

// kiểm tra act và điều hướng tới các controller phù hợp
match ($act) {
    '/' => $home->views_home(),
    
    // Sản phẩm và tìm kiếm
    'sanpham' => $home->views_sanpham(),
    'search' => $home->views_search(), // Thêm route riêng cho tìm kiếm
    
    // Chi tiết sản phẩm
    'chitietsp' => $home->views_chitietsp(),
    
    // Liên hệ
    'lienhe' => $home->views_lienhe(),
    
    // Đăng nhập/Đăng ký
    'login' => (new LoginController())->login(),
    'logout' => (new LoginController())->logout(),
    'register' => (new LoginController())->register(),
    
};

require_once './views/layout/footer.php';