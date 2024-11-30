<?php
class OrderController{
    private $modelOrder;
    

    public function __construct(){
        $this->modelOrder = new Order();

    }
    public function views_order() {
        $orders=$this->modelOrder->getAll();
        $orders_items=$this->modelOrder->getAllOrderItem();
        $danhgias=$this->modelOrder->getAllDanhGia();
        require_once 'clients/views/donhang/thongtin.php';
        // require_once 'clients/views/donhang/donhang.php';
    }
    public function formchitietdonhang(){
        $orders_items=$this->modelOrder->getAllOrderItem();
        require_once 'clients/views/donhang/chitietdonhang.php';
        
    }
    public function addReview() {
        // var_dump($_SERVER['REQUEST_METHOD']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $user_id = $_POST['user_id'] ?? null;
            $comic_id = $_POST['comic_id'] ?? null;
            $rating = $_POST['rating'] ?? null;
            $review_text = $_POST['review_text'] ?? '';

            // Kiểm tra dữ liệu hợp lệ
            if (empty($user_id) || empty($comic_id) || empty($rating) || empty($review_text)) {
                echo "Dữ liệu không hợp lệ. Vui lòng điền đầy đủ thông tin!";
                return false;
            }

            // Gọi model để thêm đánh giá
            $result = $this->modelOrder->addReview($user_id, $comic_id, $rating, $review_text);

            if ($result) {
                // Điều hướng hoặc phản hồi nếu thành công
                header("Location: ?act=don-hang");
                exit;
            } else {
                echo "Có lỗi xảy ra khi thêm đánh giá. Vui lòng thử lại!";
            }
        }
    }
  
}