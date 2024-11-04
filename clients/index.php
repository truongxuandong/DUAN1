<?php

require_once '../commons/env.php';
require_once '../commons/core.php';

require_once './views/layout/header.php';
#require Controller
require_once '../clients/controllers/HomeController.php';




 #require Model



 $home = new HomeController();





 // Route
 $act = $_GET['act'] ?? '/';



// kiểm tra act và điều hướng tới các controller phù hợp
match ($act) {
    
    '/' => $home ->views_home(),

    
};






require_once './views/layout/footer.php';