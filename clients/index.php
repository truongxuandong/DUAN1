<?php
session_start();

require_once '../commons/env.php';
require_once '../commons/core.php';

require_once './views/layout/header.php';
// require_once './views/layout/sidebar.php';

#require Controller
require_once '../clients/controllers/HomeController.php';
require_once '../clients/controllers/CartController.php';
require_once '../clients/controllers/LoginController.php';




#require Model
require_once '../clients/models/Cart.php';
require_once '../clients/models/Login.php';



$home = new HomeController();





// Route
$act = $_GET['act'] ?? '/';



// kiểm tra act và điều hướng tới các controller phù hợp
match ($act) {

    '/' => $home->views_home(),
    'san-pham' => (new HomeController())->listsanpham(),
    'gio-hang' => (new HomeController())->giohang(),
    'lien-he' => (new HomeController())->lienhe(),
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
