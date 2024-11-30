<?php
class Binhluan{
    public $conn;
    public function __construct()
    {
        $this->conn=connectDB();
    }
    public function getAllBinhLuan() {
        try {
            // Sửa câu truy vấn SQL để không có điều kiện WHERE user_id
            $sql = "SELECT comment.*, users.name, comics.title 
                    FROM comment
                    INNER JOIN users ON comment.user_id = users.id
                    INNER JOIN comics ON comment.comics_id = comics.id
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
    //danh gia
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
    public function addComment($user_id, $comics_id, $Content) {
        try {
            $sql = "INSERT INTO comment (user_id, comics_id, Content) VALUES (:user_id, :comics_id, :Content)";
            $stmt = $this->conn->prepare($sql);
    
            // Thực thi câu lệnh SQL
            $stmt->execute([
                'user_id' => $user_id,
                'comics_id' => $comics_id,
                'Content' => $Content
            ]);
    
          
            return true; // Trả về true nếu ít nhất 1 dòng bị ảnh hưởng
        } catch (Exception $e) {
            // Xử lý lỗi, ví dụ: ghi vào log hoặc thông báo cho người dùng
            echo 'Lỗi: ' . $e->getMessage();
            return false; // Trả về false nếu có lỗi xảy ra
        }
    }
    

  
}