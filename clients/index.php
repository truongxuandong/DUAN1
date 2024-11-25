<?php
session_start();
require_once '../commons/core.php';

// Tạo đối tượng PDO
$pdo = new PDO('mysql:host=localhost;dbname=duan1', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

require_once '../commons/env.php';
require_once './views/layout/header.php';
// require_once './views/layout/sidebar.php';

#require Controller
require_once '../clients/controllers/HomeController.php';
require_once '../clients/controllers/CartController.php';
require_once '../clients/controllers/LoginController.php';
require_once '../clients/controllers/AccountController.php';

#require Model
require_once '../clients/models/Cart.php';
require_once '../clients/models/Login.php';
require_once '../clients/models/Account.php';

require_once './models/danhmuc.php';
require_once './models/sanpham.php';


 $home = new HomeController();
 

// Route
$act = $_GET['act'] ?? '/';

// kiểm tra act và điều hướng tới các controller phù hợp
match ($act) {

    '/' => $home->views_home(),

    //chitietsp
    'chitietsp' => $home->views_chitietsp(),

    //sanpham
    'sanpham' => $home->views_sanpham(),

    //lienhe
    'lienhe' => $home->views_lienhe(),

    //router gio hang

    'add-item-to-cart' => (new ShoppingCartController())->addItemToCart(),
    'view-shopping-cart' => (new ShoppingCartController())->view_shoppingCart(),
    'update-quantity' => (new ShoppingCartController())->updateQuantity(),
    'delete-item' => (new ShoppingCartController())->deleteItem(),


    'login' => (new LoginController())->login(),
    'logout' => (new LoginController())->logout(),
    'register' => (new LoginController())->register(),

    // Cập nhật phương thức này để truyền PDO vào AccountController
    'profile' => (new AccountController($pdo))->profile(),
    'edit-profile' => (new AccountController($pdo))->editProfile(),
    'change-password' => (new AccountController($pdo))->changePassword(),
};
require_once './views/layout/footer.php';
