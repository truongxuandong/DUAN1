<?php 

class HomeController 
{
    public $home;
    public $modelDanhMuc;
    public $modelSanPham;
    public $modelBinhluan;
    public $modelBanner;


    public function __construct() {
        $this->modelDanhMuc = new DanhMuc();
        $this->modelSanPham = new SanPham();
        $this->modelBinhluan = new Binhluan();
        $this->modelBanner = new Banner();

    }

    public function views_home() {
        try {
            $listdm = $this->modelDanhMuc->getAllDanhMuc();
            $sanphamnew = $this->modelSanPham->getAllSanPham();
            $sanphams_hot = $this->modelSanPham->getAllSanPhamHot();
            $sanphams_sale=$this->modelSanPham->getAllSanPhamSale();
            $banners=$this->modelBanner->getAllbanner();

           
            
            require_once 'clients/views/layout/navbar.php';
            require_once 'clients/views/home.php';
        } catch (Exception $e) {
            error_log("Lỗi trong views_home: " . $e->getMessage());
        }
    }
    public function views_chitietsp() {
          $binhluans = $this->modelBinhluan->getAllBinhLuan();
        // var_dump($binhluans);
        $danhgias=$this->modelBinhluan->getAllDanhGia();
        if (!isset($_GET['id'])) {
            // Xử lý khi không có id
            header('Location: clients');
            return;
        }
      
        $sanphamct = $this->modelSanPham->getSanPhamById($_GET['id']);
        $sanphamct['variants'] = $this->modelSanPham->getSanPhamAllVariant($_GET['id']);
        $sanphamcungloai = [];
        
        if ($sanphamct) {
            $sanphamcungloai = $this->modelSanPham->getSanPhamCungLoai($sanphamct['category_id'],$_GET['id']);
        }
        
        require_once 'clients/views/chitietsp.php';
    }
    public function views_sanpham() {
        $listsp= $this->modelSanPham->getAllSanPham();
        require_once 'clients/views/sanpham.php';
    }

    public function views_lienhe() {
        require_once 'clients/views/contact.php';
    }
    public function views_search() {
        try {
            // Lấy tham số tìm kiếm từ URL
            $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
            $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : '';
            $price_range = isset($_GET['price_range']) ? $_GET['price_range'] : '';
            $sort = isset($_GET['sort']) ? $_GET['sort'] : '';

            // Xử lý price range
            $price_min = 0;
            $price_max = PHP_INT_MAX;
            if (!empty($price_range)) {
                list($price_min, $price_max) = explode('-', $price_range);
            }

            // Lấy danh sách danh mục cho form lọc
            $listdm = $this->modelDanhMuc->getAllDanhMuc();

            // Tìm kiếm sản phẩm
            $listsp = $this->modelSanPham->searchProducts(
                $keyword,
                $category_id,
                $price_min,
                $price_max,
                $sort
            );

            // Load view
            require_once 'clients/views/search.php';
        } catch (Exception $e) {
            error_log("Lỗi trong views_search: " . $e->getMessage());
            $error_message = "Đã xảy ra lỗi khi tìm kiếm sản phẩm.";
            require_once 'clients/views/search.php';
           
        }
    }  
    public function addBinhluan() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $_POST['user_id'] ?? null;
            $comics_id = $_POST['comics_id'] ?? null;
            $Content = $_POST['Content'] ?? null;
            // var_dump($comics_id,$user_id);

            if ($user_id && $comics_id && $Content) {
                $result = $this->modelBinhluan->addComment($user_id, $comics_id, $Content);
    
                if ($result) {
                    header('location:?act=chitietsp&id='.$comics_id);
                } else {
                    echo "Đã có lỗi xảy ra khi thêm bình luận.";
                }
            } else {
                echo "Vui lòng nhập đầy đủ thông tin.";
            }
        }
    }
    
    
} 