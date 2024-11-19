<?php 

class HomeController 
{
    public $home;
    public $modelDanhMuc;
    public $modelSanPham;

    public function __construct() {
        $this->modelDanhMuc = new DanhMuc();
        $this->modelSanPham = new SanPham();

    }

    public function views_home() {
        $listdm = $this->modelDanhMuc->getAllDanhMuc();
        $sanphams = $this->modelSanPham->getAllSanPham();

        require_once './views/layout/navbar.php';
        require_once './views/home.php';
    }
    public function views_chitietsp() {
        $sanphamct = $this->modelSanPham->getSanPhamById($_GET['id']);
        require_once './views/chitietsp.php';
    }
    
} 