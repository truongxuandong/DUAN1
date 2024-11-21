<?php

class SanPhamController {
    public $modelSanPham;
    public $modelDanhMuc;
    public $modelVariants;

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelDanhMuc = new DanhMuc();
        $this->modelVariants = new Variant(); 
    }

    public function danhSachSanPham()
    {
        $listsp = $this->modelSanPham->getAllSanPham();
        require_once "./views/sanpham/listsp.php";
    }

    public function formAddSanPham()
    {
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        $listTacGia = $this->modelSanPham->getAllTacGia();
        require_once './views/sanpham/addsp.php';
    }

    public function postAddSanPham()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get form data
            $title = $_POST['title'] ?? '';
            $author_id = $_POST['author_id'] ?? '';
            $category_id = $_POST['category_id'] ?? '';
            $description = $_POST['description'] ?? '';
            $publication_date = $_POST['publication_date'] ?? '';
            $price = $_POST['price'] ?? '';
            $original_price = $_POST['original_price'] ?? '';
            $stock_quantity = $_POST['stock_quantity'] ?? '';
            $image = '';

            // Handle image upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $uploadDir = '../uploads/product/';
                $fileName = time() . '_' . $_FILES['image']['name'];
                $uploadFile = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $image = $uploadFile;
                } else {
                    $_SESSION['error'] = "Không thể tải lên ảnh. Vui lòng thử lại!";
                    return;
                }
            }

            // Insert product
            if ($this->modelSanPham->insertSanPham($title, $author_id, $category_id, $description, $publication_date, $price, $original_price, $stock_quantity, $image)) {
                $_SESSION['success'] = "Thêm sản phẩm thành công!";
                header('Location:?act=san-pham');
                exit();
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra khi thêm sản phẩm!";
            }
        }
    }

    public function formEditSanPham()
    {
        $id = $_GET['id'];
        $comic = $this->modelSanPham->getSanPhamById($id);
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        $listTacGia = $this->modelSanPham->getAllTacGia();
        require_once './views/sanpham/editsp.php';
    }

    public function postEditSanPham()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $comicId = $_POST['id'];
            $title = $_POST['title'];
            $author_id = $_POST['author_id'];
            $category_id = $_POST['category_id'];
            $description = $_POST['description'];
            $publication_date = $_POST['publication_date'];
            $price = $_POST['price'] ?? '';
            $original_price = $_POST['original_price'] ?? '';
            $stock_quantity = $_POST['stock_quantity'];
            $image = $_POST['old_image']; // Keep the old image if not uploading a new one

            // Handle image upload if new image is provided
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $uploadDir = '../uploads/product/';
                $fileName = time() . '_' . basename($_FILES['image']['name']);
                $uploadFile = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $image = $uploadFile;
                } else {
                    $_SESSION['error'] = "Không thể tải lên ảnh mới.";
                    header('Location: ?act=san-pham&method=formEditSanPham&id=' . $comicId);
                    exit();
                }
            }

            // Update product
            if ($this->modelSanPham->updateSanPham($comicId, $title, $author_id, $category_id, $description, $publication_date, $price, $original_price, $stock_quantity, $image)) {
                $_SESSION['success'] = "Cập nhật sản phẩm thành công!";
                header('Location: ?act=san-pham');
                exit();
            } else {
                $_SESSION['error'] = "Cập nhật sản phẩm thất bại.";
                header('Location: ?act=san-pham&method=formEditSanPham&id=' . $comicId);
                exit();
            }
        }
    }

    public function postDeleteSanPham()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Delete product
            if ($this->modelSanPham->deleteSanPham($id)) {
                $_SESSION['success'] = "Sản phẩm đã được xóa thành công!";
                header('Location: ?act=san-pham');
                exit();
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra khi xóa sản phẩm!";
                header('Location: ?act=san-pham');
                exit();
            }
        }
    }
    public function danhSachVariants()
    {
        $comic_id = $_GET['id'] ?? null;
        if (!$comic_id) {
            $_SESSION['error'] = "Không tìm thấy thông tin sản phẩm";
            header('Location: ?act=san-pham');
            exit();
        }
        
        $listVariants = $this->modelVariants->getVariantsByComicId($comic_id);
        require_once "./views/sanpham/bienthesp.php";
    }

    public function formAddVariant()
    {
        $comic_id = $_GET['comic_id'] ?? null;
       
        
        if (!$comic_id) {
            $_SESSION['error'] = "Không tìm thấy thông tin sản phẩm";
            // header('Location: ?act=san-pham');
            exit();
        }
        
        $comic = $this->modelSanPham->getSanPhamById($comic_id);
        
        if (!$comic) {
            $_SESSION['error'] = "Không tìm thấy thông tin sản phẩm";
            header('Location: ?act=san-pham');
            exit();
        }
        
        require_once './views/sanpham/addbienthesp.php';
    }
    
    

    // Handle POST request to add a new variant
    public function postAddVariant()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Debug để kiểm tra dữ liệu POST
            // var_dump($_POST); exit;
            
            $comic_id = $_POST['comic_id'] ?? '';
            if (empty($comic_id)) {
                $_SESSION['error'] = "Không tìm thấy thông tin sản phẩm";
                header('Location: ?act=san-pham');
                exit();
            }
            
            // Get form data
            $format = $_POST['format'] ?? '';
            $language = $_POST['language'] ?? '';
            $isbn = $_POST['isbn'] ?? '';
            $original_price = $_POST['original_price'] ?? 0;
            $price = $_POST['price'] ?? 0;
            $stock_quantity = $_POST['stock_quantity'] ?? 0;
            $publication_date = $_POST['publication_date'] ?? '';
            $image = '';

            // Handle image upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $uploadDir = '../uploads/variants/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                $fileName = time() . '_' . basename($_FILES['image']['name']);
                $uploadFile = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $image = $uploadFile;
                } else {
                    $_SESSION['error'] = "Không thể tải lên ảnh. Vui lòng thử lại!";
                    header('Location: ?act=form-them-bien-the&comic_id=' . $comic_id);
                    exit();
                }
            }

            // Insert variant
            if ($this->modelVariants->insertVariant($comic_id, $format, $language, $isbn, $original_price, $price, $stock_quantity, $publication_date, $image)) {
                $_SESSION['success'] = "Thêm biến thể thành công!";
                header('Location: ?act=chi-tiet-bien-the-sp&id=' . $comic_id);
                exit();
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra khi thêm biến thể!";
                header('Location: ?act=form-them-bien-the&comic_id=' . $comic_id);
                exit();
            }
        }
    }

    // Show form to edit an existing variant
    public function formEditVariant()
    {
        $variantId = $_GET['id'];  // Variant ID passed in the URL
        $variant = $this->modelVariants->getVariantById($variantId);  // Get the variant data
        require_once './views/sanpham/editbienthesp.php';  // Adjust the view file accordingly
    }

    // Handle POST request to edit an existing variant
    public function postEditVariant()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           
            // Get form data
            $variantId = $_POST['id'];
            $comicId = $_POST['comic_id'];
            $format = $_POST['format'];
            $language = $_POST['language'];
            $originalPrice = $_POST['original_price'] ?? 0;
            $price = $_POST['price'] ?? 0;
            $stock_quantity = $_POST['stock_quantity'];
            $publication_date = $_POST['publication_date'];
            $isbn = $_POST['isbn'];
            $image = $_POST['old_image']; // Keep old image if no new image is uploaded

            // Validate form data
            if (empty($comicId) || empty($format) || empty($language)) {
                $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin!";
                header('Location: ?act=sua-bien-the&id=' . $variantId);
                exit();
            }

            // Handle image upload if a new image is provided
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $uploadDir = '../uploads/variants/';
                $fileName = time() . '_' . basename($_FILES['image']['name']);
                $uploadFile = $uploadDir . $fileName;

                // Validate file type and size (same as before)
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($_FILES['image']['type'], $allowedTypes)) {
                    $_SESSION['error'] = "Chỉ cho phép tải lên hình ảnh (JPEG, PNG, GIF)!";
                    header('Location: ?act=sua-bien-the&id=' . $variantId);
                    exit();
                }

                if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
                    $_SESSION['error'] = "Kích thước ảnh không được vượt quá 2MB!";
                    header('Location: ?act=sua-bien-the&id=' . $variantId);
                    exit();
                }

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $image = $uploadFile;
                } else {
                    $_SESSION['error'] = "Không thể tải lên ảnh mới.";
                    header('Location: ?act=sua-bien-the&id=' . $variantId);
                    exit();
                }
            }

            // Update the variant in the database
            if ($this->modelVariants->updateVariant($variantId, $comicId, $format, $language, $isbn, $originalPrice, $price, $stock_quantity, $publication_date, $image)) {
                $_SESSION['success'] = "Cập nhật biến thể thành công!";
                header('Location: ?act=chi-tiet-bien-the-sp&id=' . $comicId);
                exit();
            } else {
                $_SESSION['error'] = "Cập nhật biến thể thất bại!";
                header('Location: ?act=sua-bien-the&id=' . $variantId);
                exit();
            }
        }
    }

    // Handle POST request to delete a variant
    public function postDeleteVariant()
    {
        if (isset($_GET['id'])) {
            $variantId = $_GET['id'];

            // Get variant data to check for image path
            $variant = $this->modelVariants->getVariantById($variantId);
            $comicId = $variant['comic_id'];  // Get comic_id for redirect
            $imagePath = $variant['image'];

            // Delete the variant from the database
            if ($this->modelVariants->deleteVariant($variantId)) {
                // Delete the image if it exists
                if (!empty($imagePath) && file_exists($imagePath)) {
                    unlink($imagePath);
                }

                $_SESSION['success'] = "Biến thể đã được xóa thành công!";
                header('Location: ?act=chi-tiet-bien-the-sp&id=' . $comicId);
                exit();
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra khi xóa biến thể!";
                header('Location: ?act=quan-ly-bien-the-san-pham&comic_id=' . $comicId);
                exit();
            }
        }
    }
}
?>