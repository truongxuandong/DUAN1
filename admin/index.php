<?php
session_start();

require_once '../commons/env.php';
require_once '../commons/core.php';

require_once './views/layout/header.php';
#require Controller
require_once '../admin/controllers/HomeController.php';
require_once '../admin/controllers/GiaodienController.php';
require_once '../admin/controllers/BinhluanController.php';





 #require Model


 require_once './models/AdminBinhluan.php';
 require_once './models/AdminBanner.php';



 $home = new HomeController();





 // Route
 $act = $_GET['act'] ?? '/';



// kiểm tra act và điều hướng tới các controller phù hợp
match ($act) {
    
    '/' => $home ->views_home(),

    //banner
    'giao-dien'=>(new AdminGiaodienController())->listBanner(),
    'form-add-banner'=>(new AdminGiaodienController())->formaddBanner(),
    'add-banner'=>(new AdminGiaodienController())->postaddBanner(),
    'toggle-banner-status'=>(new AdminGiaodienController())->UpdataBannerStatus(),
    'delete-banner'=>(new AdminGiaodienController())->deleteBanner(),
    'form-edit-banner'=>(new AdminGiaodienController())->formEditBanner(),
    'edit-banner'=>(new AdminGiaodienController())->postEditBanner(),

   
    //binh luan
    'binh-luan'=>(new AdminBinhluanController())->listBinhluan(),
    'update-trang-thai-binh-luan'=>(new AdminBinhluanController())->updateTrangThaiBinhLuan(),

    'danh-gia'=>(new AdminBinhluanController())->listDanhgia(),
    'delete-danhgia'=>(new AdminBinhluanController())->approveDanhGia(),
    'approve-danhgia'=>(new AdminBinhluanController())->approveDanhGia(),
    'reject-danhgia'=>(new AdminBinhluanController())->rejectDanhGia(),





    
};






require_once './views/layout/footer.php';