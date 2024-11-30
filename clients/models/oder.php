<?php
class Order{
    private $conn;
    public function __construct(){
        $this->conn = connectDB();
    }

    public function getAll() {
        try {
            $sql = "SELECT * from orders";
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function getAllOrderItem() {
        try{
            $sql = "SELECT quantity,unit_price,subtotal,order_id,
                orders.*,
                comics.*
            FROM 
                order_items
            INNER JOIN 
                orders ON order_items.order_id = orders.id
            INNER JOIN 
                comics ON order_items.comic_id = comics.id;
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
            
        }catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function getAllDanhGia(){
        try {
            // Sửa câu truy vấn SQL để không có điều kiện WHERE user_id
            $sql = "SELECT reviews.*, users.name, comics.title 
                    FROM reviews
                    INNER JOIN users ON reviews.user_id = users.id
                    INNER JOIN comics ON reviews.comic_id = comics.id
                    ";
            
            // Thực thi câu truy vấn
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            
            // Trả về tất cả bình luận
            return $stmt->fetchAll();
        } catch (Exception $e) {
            // Xử lý lỗi nếu có
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
    public function addReview($user_id, $comic_id, $rating, $review_text) {
        try {
            $sql = "INSERT INTO reviews (user_id, comic_id, rating, review_text, status, created_at) 
                    VALUES (:user_id, :comic_id, :rating, :review_text, :status, NOW())";
            $stmt = $this->conn->prepare($sql);
    
            // Thực thi câu lệnh SQL
            $stmt->execute([
                'user_id' => $user_id,
                'comic_id' => $comic_id,
                'rating' => $rating,
                'review_text' => $review_text,
                'status' => 'approved' // Đặt trạng thái mặc định là "approved"
            ]);
    
            return true; // Thành công
        } catch (Exception $e) {
            // Xử lý lỗi
            echo 'Lỗi: ' . $e->getMessage();
            return false; // Thất bại
        }
    }
    //hàm kiểm tra đánh giá chưa
    public function hasReviewed($user_id, $comic_id) {
        $sql = "SELECT COUNT(*) FROM reviews WHERE user_id = :user_id AND comic_id = :comic_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'user_id' => $user_id,
            'comic_id' => $comic_id
        ]);
        $count = $stmt->fetchColumn();
        return $count > 0; // Trả về true nếu đã đánh giá
    }
    

}
