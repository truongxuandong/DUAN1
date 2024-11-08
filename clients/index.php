<?php

require_once '../commons/env.php';
require_once '../commons/core.php';

#require Controller
require_once '../clients/controllers/HomeController.php';




 #require Model



 $home = new HomeController();





 // Route
 $act = $_GET['act'] ?? '/';



// kiểm tra act và điều hướng tới các controller phù hợp
match ($act) {
    
    '/' => $home ->views_home(),
    'san-pham' =>(new HomeController())->listsanpham(),
    'gio-hang' =>(new HomeController())->giohang(),
    'lien-he' =>(new HomeController())->lienhe(),

    
};





