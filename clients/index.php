<?php
// Start the session
session_start();
require_once '../commons/core.php';
require_once '../commons/env.php';
require_once './views/layout/header.php';
// require_once './views/layout/sidebar.php';

#require Controller
require_once '../clients/controllers/HomeController.php';
require_once '../clients/controllers/CartController.php';
require_once '../clients/controllers/LoginController.php';




#require Model
require_once '../clients/models/Cart.php';
require_once '../clients/models/Login.php';

 
require_once './models/danhmuc.php';
require_once './models/sanpham.php';

// Instantiate the HomeController
$home = new HomeController();


 $home = new HomeController();
 




// Route
$act = $_GET['act'] ?? '/';



// kiểm tra act và điều hướng tới các controller phù hợp
match ($act) {
    
    '/' => $home ->views_home(),
    
    //chitietsp
    'chitietsp' => $home ->views_chitietsp(),
    
    //sanpham
    'sanpham' => $home ->views_sanpham(),
    
    //lienhe
    'lienhe' => $home ->views_lienhe(),
    
   
    'timkiem' => $home->views_timkiem(),
    

   
    // 'gio-hang' => (new HomeController())->giohang(),
    
    //router gio hang 
    'show-cart' => (new CartController())->showCart(),
    'add-to-cart' => (new CartController())->addToCart(),
    'update-cart' => (new CartController())->updateCart(),
    'remove-from-cart' => (new CartController())->removeFromCart(),
    //
    'login' => (new LoginController())->login(),
    'logout' => (new LoginController())->logout(),
    'register' => (new LoginController())->register(),
};





require_once './views/layout/footer.php';


