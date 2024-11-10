<?php

class SanPhamController {
    public $modelSanPham;
    public $modelDanhMuc;
    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        // $this->modelSanPham = new DanhMuc();
    }
    public function danhSachSanPham(){
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './admin/views/sanpham/listsp.php';
    }
    public function formAddSanPham() {
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './admin/views/sanpham/addsp.php';
    }
    public function postAddSanPham() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $title = $_POST['title'];
            $author_id = $_POST['author_id'];
            $category_id = $_POST['category_id'];
            $description = $_POST['description'];
            $publication_date = $_POST['publication_date'];
            $price = $_POST['price'];
            $stock_quantity = $_POST['stock_quantity'];
            $image = $_POST['image'];

            $hinh_anh = $_FILES['hinh_anh'];
            $file_thumb = uploadFile($hinh_anh, './uploads/');
            $img_array = $_FILES['img_array'];


            $errors = [];
            if(empty($title)){
                $errors['title'] = 'Tên sản phẩm không được để trống';
            }
            if(empty($author_id)){
                $errors['author_id'] = 'Tên tác giả không được để trống';
            }
            if(empty($category_id)){
                $errors['category_id'] = 'Mã thể loại không được để trống';
            }
            if(empty($description)){
                $errors['description'] = 'Mô tả không được để trống';
            }
            if(empty($publication_date)){
                $errors['publication_date'] = 'Ngày phát hành không được để trống';
            }
            if(empty($price)){
                $errors['price'] = 'Giá sản phẩm không được để trống';
            }
            if(empty($stock_quantity)){
                $errors['stock_quantity'] = 'Số lượng sản phẩm không được để trống';
            }
            if(empty($image)){
                $errors['image'] = 'Hình ảnh không được để trống';
            }

            if(empty($errors)){
                $this->modelSanPham->insertSanPham($title, $author_id, $category_id, $description, $publication_date, $price, $stock_quantity, $image, $file_thumb);
                header("Location:" . BASE_URL_ADMIN . '?act=san-pham');
                exit();
            } else{
                require_once './admin/views/sanpham/addsp.php';
            }
        }
    }
}