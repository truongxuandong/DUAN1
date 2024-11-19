<?php
session_start();
require_once '../commons/env.php';
require_once '../commons/core.php';
require_once './views/layout/header.php';
require_once './views/layout/navbar.php';
#require Controller
require_once './controllers/HomeController.php';




 #require Model
require_once './models/danhmuc.php';
require_once './models/sanpham.php';


 $home = new HomeController();





 // Route
 $act = $_GET['act'] ?? '/';



// kiểm tra act và điều hướng tới các controller phù hợp
match ($act) {
    
    '/' => $home ->views_home(),

    //chitietsp
    'chitietsp' => $home ->views_chitietsp(),
    

    
};



require_once './views/layout/footer.php';


