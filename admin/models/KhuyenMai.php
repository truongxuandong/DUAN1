<?php
class KhuyenMaiModel {
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllKhuyenMai()
    {
        try {
            $sql = "SELECT comic_sales.* ,comics.title
            FROM comic_sales
            Join comics on comics.id = comic_sales.comic_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
    public function getAllIdSp()
    {
        try {
            $sql = "SELECT comics.title ,comics.id FROM comics ";
           
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
    public function addKhuyenMai($comic_id, $sale_type, $sale_value, $start_date, $end_date, $status) {
        try {
            // Nếu cần chuyển đổi timestamp sang DATE
            $start_date = date('Y-m-d H:i', $start_date);
            $end_date = date('Y-m-d H:i', $end_date);
    
            $sql = "INSERT INTO comic_sales (comic_id, sale_type, sale_value, start_date, end_date, status) 
            VALUES (:comic_id, :sale_type, :sale_value, :start_date, :end_date, :status)";

            $stmt = $this->conn->prepare($sql);
    
            $result = $stmt->execute([
                ':comic_id' => $comic_id,
                ':sale_type' => $sale_type,
                ':sale_value' => $sale_value,
                ':start_date' => $start_date,
                ':end_date' => $end_date,
                ':status' => $status
            ]);
    
            if ($result) {
                return true;
            } else {
                error_log("SQL Error: " . implode(", ", $stmt->errorInfo()));
                return false;
            }
        } catch (Exception $e) {
            error_log("Exception: " . $e->getMessage());
            return false;
        }
    }
    
    public function getKhuyenMaiById($id){
        try {
            $sql = "SELECT comic_sales.* ,comics.title
            FROM comic_sales
            Join comics on comics.id = comic_sales.comic_id
            Where comic_sales.id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
            ':id' => $id
        ]);
        return $stmt->fetch();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
    public function updateKhuyenMai($id, $comic_id, $sale_type, $sale_value, $start_date, $end_date, $status) {
        try {
            $start_date = date('Y-m-d H:i', $start_date);
            $end_date = date('Y-m-d H:i', $end_date);
            $sql = "UPDATE comic_sales 
        SET comic_id = :comic_id, 
            sale_type = :sale_type, 
            sale_value = :sale_value, 
            start_date = :start_date, 
            end_date = :end_date, 
            status = :status
            WHERE id = :id";

            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
                ':comic_id' => $comic_id,
                ':sale_type' => $sale_type,
                ':sale_value' => $sale_value,
                ':start_date' => $start_date,
                ':end_date' => $end_date,
                ':status' => $status
            ]);
            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
            return false;
        }
    }
    public function deleteKhuyenMai($id) {
        try {
            $sql = "DELETE FROM comic_sales WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([":id" => $id]);
            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
            return false;
        }
    }
}
?>