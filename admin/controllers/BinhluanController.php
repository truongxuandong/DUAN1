<?php 
class AdminBinhluanController
{
   public $modelbinhluan;
   public $modeldanhgia;

   public function __construct(){
      $this->modelbinhluan = new AdminBinhluan();
      $this->modeldanhgia = new AdminBinhluan();
   }
   public function listBinhluan() {
    // Lấy tất cả bình luận từ model mà không cần tham số id
    $comments = $this->modelbinhluan->getAllBinhLuan();  // Hàm này sẽ lấy tất cả bình luận
    // Truyền dữ liệu sang view
    require_once './views/binhluan/listbinhluan.php';
}
   public function updateTrangThaiBinhLuan()
    {
        $id_binh_luan = $_POST['id_binh_luan'];
        $name_view = $_POST['name_view'];
        $binhLuan = $this->modelbinhluan->getDetailBinhLuan($id_binh_luan);
        if ($binhLuan) {
            $trang_thai_update = '';
            if ($binhLuan['status'] == 1) {
                $trang_thai_update = 2;
            } else {
                $trang_thai_update = 1;
            }
            $status = $this->modelbinhluan->updateTrangThaiBinhLuan($id_binh_luan, $trang_thai_update);
            if($status){
                header("location:" . BASE_URL_ADMIN . '?act=binh-luan');
                exit();
            }
        }
    }
    // đánh giá
    public function listDanhgia(){
        $danhgias=$this->modelbinhluan->getalldanhgia();
        require './views/binhluan/listdanhgia.php';

    }
    //xoa
    public function deletedanhgia()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];  // Lấy id banner từ URL
       
            // Lấy thông tin banner từ model
            $banner = $this->modelbinhluan->getalldanhgia($id);
    
            // Kiểm tra nếu banner tồn tại
            if ($banner) {
                $delete = $this->modelbinhluan->deleteDanhgia($id);
                header("Location: " . BASE_URL_ADMIN . '?act=danh-gia');
                exit();
            } else {
                echo "loi";
            }
        } else {
            echo"loi";
        }
    }
    //trạng thái
      // Hàm duyệt đánh giá
      public function approveDanhGia()
      {
          // Kiểm tra có id trong URL không
          if (isset($_GET['id'])) {
              $id = $_GET['id'];  // Lấy id đánh giá từ URL
  
              // Cập nhật trạng thái của đánh giá thành 'approved'
              $status = 'approved';
              $result = $this->modelbinhluan->updateTrangThaiDanhGias($id, $status);
  
              // Kiểm tra kết quả và chuyển hướng về danh sách
              if ($result) {
                  header("Location: " . BASE_URL_ADMIN . "?act=danh-gia");
                  exit();
              } else {
                  echo "Cập nhật trạng thái thất bại!";
                  exit();
              }
          } else {
              echo "ID không hợp lệ!";
              exit();
          }
      }
  
      // Hàm từ chối đánh giá
      public function rejectDanhGia()
      {
          // Kiểm tra có id trong URL không
          if (isset($_GET['id'])) {
              $id = $_GET['id'];  // Lấy id đánh giá từ URL
  
              // Cập nhật trạng thái của đánh giá thành 'rejected'
              $status = 'rejected';
              $result = $this->modelbinhluan->updateTrangThaiDanhGias($id, $status);
  
              // Kiểm tra kết quả và chuyển hướng về danh sách
              if ($result) {
                  header("Location: " . BASE_URL_ADMIN . "?act=danh-gia");
                  exit();
              } else {
                  echo "Cập nhật trạng thái thất bại!";
                  exit();
              }
          } else {
              echo "ID không hợp lệ!";
              exit();
          }
      }
  
   
}