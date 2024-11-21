<?php
class AdminBinhluan{
    public $conn;
    public function __construct()
    {
        $this->conn=connectDB();
    }
         //binh luan
         public function getAllBinhLuan() {
            try {
                // Sửa câu truy vấn SQL để không có điều kiện WHERE user_id
                $sql = "SELECT comment.*, users.name, comics.title 
                        FROM comment
                        INNER JOIN users ON comment.user_id = users.id
                        INNER JOIN comics ON comment.comics_id = comics.id";
                
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
        
    public function getDetailBinhLuan($id){
        try {
            $sql = "SELECT *FROM comment where id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        }catch (Exception $e){
            echo "lỗi" .$e->getMessage();
        }
     }
     public function updateTrangThaiBinhLuan($id,$status){
        try {
            $sql = 'update comment
                set
                status = :status
               
                where id = :id';
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                
                ':status' => $status,
                ':id' => $id
            ]);
            //lấy id sản phẩm vừa thêm
            return true;
        }catch (Exception $e){
            echo "lỗi" .$e->getMessage();
        }
    }

  
    // danh gia
    //lấy dữ liệu của bảng đánh giá và chọn vào các bảng khác
    public function getalldanhgia(){
        try{
            $sql = "SELECT reviews.*, users.name, comics.title 
                        FROM reviews
                        INNER JOIN users ON reviews.user_id = users.id
                        INNER JOIN comics ON reviews.comic_id = comics.id
                        "
                        ;
                
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
       
        // xu li xoa danh gia
        public function deleteDanhgia($id)
        {
            try {
                // Chuẩn bị câu lệnh SQL để xóa banner theo id
                $sql = 'DELETE FROM reviews 
                WHERE id = :id';
                $stmt = $this->conn->prepare($sql);
                
                $stmt->execute([':id' => $id]);
                return true;
            } catch (Exception $e) {
                echo "Lỗi: " . $e->getMessage();
                return false;
            }
        }
        // status
        public function updateTrangThaiDanhGias($id,$status){
            try {
                $sql = 'update reviews
                    set
                    status = :status
                   
                    where id = :id';
                $stmt = $this->conn->prepare($sql);
    
                $stmt->execute([
                    
                    ':status' => $status,
                    ':id' => $id
                ]);
                //lấy id sản phẩm vừa thêm
                return true;
            }catch (Exception $e){
                echo "lỗi" .$e->getMessage();
            }
        }
    }
