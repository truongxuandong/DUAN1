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
        require_once './models/sanpham.php';
        $id = $_GET['id'] ?? 0;
    
        $sanpham_model = new SanPham();
        $product = $sanpham_model->layChiTietSanPham($id); // Lấy chi tiết sản phẩm từ model
    
        if (!$product) {
            echo "<p>Sản phẩm không tồn tại.</p>";
        } else {
            require './views/chitietsp.php'; // Giao diện chi tiết sản phẩm
        }
    }
    public function views_sanpham() {
        $listsp= $this->modelSanPham->getAllSanPham();
        require_once './views/sanpham.php';
    }

    public function views_lienhe() {
        require_once './views/contact.php';
    }
    public function views_timkiem()
{
    // Get search parameters from the URL
    $query = $_GET['q'] ?? ''; 
    $category_id = $_GET['category_id'] ?? 'all';
    $price_min = $_GET['price_min'] ?? '';
    $price_max = $_GET['price_max'] ?? '';
    $min_rating = $_GET['min_rating'] ?? '';
    $page = $_GET['page'] ?? 1;  // Get the current page, default to 1
    $limit = 10;  // Define the number of products per page

    // Create an instance of the SanPham model
    $sanphamModel = new SanPham();

    // Call the filtering and search method in the model
    $products = $sanphamModel->timKiemVaLoc($query, $category_id, $price_min, $price_max, $min_rating, $page, $limit);

    // Calculate total pages for pagination
    $totalProducts = count($sanphamModel->timKiemVaLoc($query, $category_id, $price_min, $price_max, $min_rating, 1, 10000));  // Get total products to calculate pages
    $totalPages = ceil($totalProducts / $limit);

    // Include the view for displaying filtered products
    // include './views/sanpham.php';
    include './views/timkiem.php';
}

    
    
    
} 