<?php

require_once '../commons/env.php';
require_once '../commons/core.php';

require_once './views/layout/header.php';
#require Controller
require_once '../admin/controllers/HomeController.php';
require_once '../admin/controllers/GiaodienController.php';





 #require Model



 $home = new HomeController();





 // Route
 $act = $_GET['act'] ?? '/';



// kiểm tra act và điều hướng tới các controller phù hợp
match ($act) {
    
    '/' => $home ->views_home(),

    //banner-noi dung
    'giao-dien'=>(new AdminGiaodienController())->listBanner(),
};






require_once './views/layout/footer.php';