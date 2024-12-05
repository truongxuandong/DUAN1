<?php
session_start();
require_once './commons/core.php';

// Tạo đối tượng PDO
$pdo = new PDO('mysql:host=localhost;dbname=duan1', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

require_once './commons/env.php';
require_once './clients/views/layout/header.php';

#require Controller
require_once './clients/controllers/HomeController.php';
require_once './clients/controllers/CartController.php';
require_once './clients/controllers/LoginController.php';
require_once './clients/controllers/AccountController.php';
require_once './clients/controllers/CheckoutController.php';
require_once './clients/controllers/OderController.php';

#require Model
require_once './clients/models/Cart.php';
require_once './clients/models/Login.php';
require_once './clients/models/Account.php';
require_once './clients/models/Order.php';
require_once './clients/models/oder.php';
require_once './clients/models/danhmuc.php';
require_once './clients/models/sanpham.php';
require_once './clients/models/binhluan.php';
require_once './clients/models/Banner.php';

$home = new HomeController();

// Route
$act = $_GET['act'] ?? '/';

// kiểm tra act và điều hướng tới các controller phù hợp
match ($act) {
    '/' => $home->views_home(),
    'chitietsp' => $home->views_chitietsp(),
    'add-binh-luan' => $home ->addBinhluan(),

    'sanpham' => $home->views_sanpham(),
    'search' => $home->views_search(),
    'lienhe' => $home->views_lienhe(),
    'view-shopping-cart' => (new CartController())->view_shoppingCart(),
    'add-item-to-cart' => (new CartController())->addToCart(),
    'update-quantity' => (new CartController())->updateQuantity(),
    'delete-cart-item' => (new CartController())->deleteItem(),
    'login' => (new LoginController())->login(),
    'logout' => (new LoginController())->logout(),
    'register' => (new LoginController())->register(),
    'profile' => (new AccountController($pdo))->profile(),
    'edit-profile' => (new AccountController($pdo))->editProfile(),
    'change-password' => (new AccountController($pdo))->changePassword(),
    'thanhtoan' => (new CheckoutController())->index(),
    'process-checkout' => (new CheckoutController())->processCheckout(),
    'checkout' => (new CheckoutController())->index(),
    'process-checkout' => (new CheckoutController())->processCheckout(),
    'order-success' => (new CheckoutController())->orderSuccess(),

    'don-hang'=>(new OrderController())->views_order(),
    // 'chi-tiet-don-hang'=>(new OrderController())->formchitietdonhang(),
    'chi-tiet-don-hang'=>(new OrderController())->getChiTietDonHang(),
    'add-reviews'=>(new OrderController())->addReview(),
    'update-status'=>(new OrderController())->handleRequest(),
    'huy-don-hang'=>(new OrderController())->huydonhang(),

};

require_once './clients/views/layout/footer.php';