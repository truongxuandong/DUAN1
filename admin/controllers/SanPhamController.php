<?php

class SanPhamController {
    public $modelSanPham;
    public $modelDanhMuc;

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelDanhMuc = new DanhMuc();
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
            if ($this->modelSanPham->insertSanPham($title, $author_id, $category_id, $description, $publication_date, $price, $stock_quantity, $image)) {
                $_SESSION['success'] = "Thêm sản phẩm thành công!";
                header('Location: ?act=san-pham');
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
            // Get form data
            $comicId = $_POST['id'];
            $title = $_POST['title'];
            $author_id = $_POST['author_id'];
            $category_id = $_POST['category_id'];
            $description = $_POST['description'];
            $publication_date = $_POST['publication_date'];
            $price = $_POST['price'] ?? '';
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
            if ($this->modelSanPham->updateSanPham($comicId, $title, $author_id, $category_id, $description, $publication_date, $price, $stock_quantity, $image)) {
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
}
?>
