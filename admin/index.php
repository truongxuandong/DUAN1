<?php
session_start();
require_once '../commons/env.php';
require_once '../commons/core.php';
require_once './views/layout/footer.php';
require_once './views/layout/header.php';
require_once './views/layout/sidebar.php';

#require Controller

require_once './controllers/DanhMucController.php';
#require Model
require_once './models/DanhMuc.php';



 #require Model
require_once './models/User.php';


 $home = new HomeController();
 $user = new userController();






 // Route
 $act = $_GET['act'] ?? '/';



// kiểm tra act và điều hướng tới các controller phù hợp
match ($act) {

    '/' => $home->views_home(),

    // route danh mục
    'listdm' => (new DanhMucController())->danhsachDanhMuc(),
    'form-them-danh-muc' => (new DanhMucController())->formAddDanhMuc(),
    'post-danh-muc' => (new DanhMucController())->postAddDanhMuc(),
    'form-sua-danh-muc' => (new DanhMucController())->formEditDanhMuc(),
    'sua-danh-muc' => (new DanhMucController())->postEditDanhMuc(),
    'xoa-danh-muc' => (new DanhMucController())->deleteDanhMuc(),
};
