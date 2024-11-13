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





 #require Model
require_once './models/User.php';
require_once './models/Order.php';



 $home = new HomeController();
 $user = new userController();
 $order = new OrderController();






 // Route
 $act = $_GET['act'] ?? '/';



// kiểm tra act và điều hướng tới các controller phù hợp
match ($act) {
    //home
    '/' => $home ->views_home(),















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
    
};






require_once './views/layout/footer.php';