<?php
class Banner{
    public $conn;
    public function __construct()
    {
        $this->conn=connectDB();
    }
    public function getAllbanner(){
        try {
            // Sửa câu truy vấn SQL để không có điều kiện WHERE user_id
            $sql = "SELECT *from banners
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
}