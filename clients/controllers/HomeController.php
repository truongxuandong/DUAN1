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
        try {
            $listdm = $this->modelDanhMuc->getAllDanhMuc();
            $sanphamnew = $this->modelSanPham->getAllSanPham();
            $sanphams_hot = $this->modelSanPham->getAllSanPhamHot();
            $sanphams_sale=$this->modelSanPham->getAllSanPhamSale();
           
            
            require_once './views/layout/navbar.php';
            require_once './views/home.php';
        } catch (Exception $e) {
            error_log("Lỗi trong views_home: " . $e->getMessage());
        }
    }
    public function views_chitietsp() {
        if (!isset($_GET['id'])) {
            // Xử lý khi không có id
            header('Location: ./');
            return;
        }
        
        $sanphamct = $this->modelSanPham->getSanPhamById($_GET['id']);
        $sanphamct['variants'] = $this->modelSanPham->getSanPhamAllVariant($_GET['id']);
        $sanphamcungloai = [];
        
        if ($sanphamct) {
            $sanphamcungloai = $this->modelSanPham->getSanPhamCungLoai($sanphamct['category_id']);
        }
        
        require_once './views/chitietsp.php';
    }
    public function views_sanpham() {
        $listsp= $this->modelSanPham->getAllSanPham();
        require_once './views/sanpham.php';
    }

    public function views_lienhe() {
        require_once './views/contact.php';
    }
    public function views_myaccount() {
        
        require_once './views/myaccount.php';
    }
} 