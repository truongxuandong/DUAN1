<?php
session_start();
require_once '../commons/env.php';
require_once '../commons/core.php';

require_once './views/layout/header.php';
require_once './views/layout/sidebar.php';

#require Controller
require_once '../admin/controllers/HomeController.php';




 #require Model
require_once './models/User.php';


 $home = new HomeController();
 $user = new userController();






 // Route
 $act = $_GET['act'] ?? '/';



// kiểm tra act và điều hướng tới các controller phù hợp
match ($act) {
    //home
    '/' => $home ->views_home(),

    
};






require_once './views/layout/footer.php';