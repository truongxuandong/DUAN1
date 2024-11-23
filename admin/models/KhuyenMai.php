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
            // Đầu tiên, cập nhật các khuyến mãi đã hết hạn
            $updateSql = "UPDATE comic_sales 
                SET status = 'inactive' 
                WHERE end_date < NOW() 
                AND status != 'inactive'";
            $this->conn->prepare($updateSql)->execute();

            // Sau đó lấy tất cả khuyến mãi với trạng thái hiện tại
            $sql = "SELECT 
                comic_sales.*, 
                comics.title,
                CASE
                    WHEN NOW() < STR_TO_DATE(comic_sales.start_date, '%Y-%m-%d %H:%i:%s') THEN 'pending'
                    WHEN NOW() BETWEEN STR_TO_DATE(comic_sales.start_date, '%Y-%m-%d %H:%i:%s') AND STR_TO_DATE(comic_sales.end_date, '%Y-%m-%d %H:%i:%s') THEN 'active'
                    WHEN NOW() > STR_TO_DATE(comic_sales.end_date, '%Y-%m-%d %H:%i:%s') THEN 'inactive'
                    ELSE comic_sales.status
                END
            FROM comic_sales
            JOIN comics on comics.id = comic_sales.comic_id";
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
            $sql = "SELECT 
                comic_sales.*, 
                comics.title,
                CASE
                    WHEN NOW() < STR_TO_DATE(comic_sales.start_date, '%Y-%m-%d %H:%i:%s') THEN 'pending'
                    WHEN NOW() BETWEEN STR_TO_DATE(comic_sales.start_date, '%Y-%m-%d %H:%i:%s') AND STR_TO_DATE(comic_sales.end_date, '%Y-%m-%d %H:%i:%s') THEN 'active'
                    WHEN NOW() > STR_TO_DATE(comic_sales.end_date, '%Y-%m-%d %H:%i:%s') THEN 'expired'
                    ELSE comic_sales.status
                END as current_status
            FROM comic_sales
            JOIN comics on comics.id = comic_sales.comic_id
            WHERE comic_sales.id = :id";
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
    public function updateExpiredPromotions() {
        try {
            $sql = "UPDATE comic_sales 
                    SET status = 'inactive' 
                    WHERE end_date < NOW() 
                    AND status != 'inactive'";
            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute();
            
            return $result;
        } catch (Exception $e) {
            error_log("Error updating expired promotions: " . $e->getMessage());
            return false;
        }
    }
    public function checkExistingPromotion($comic_id, $start_date, $end_date, $id = null) {
        try {
            $sql = "SELECT COUNT(*) FROM comic_sales 
                    WHERE comic_id = :comic_id 
                    AND ((start_date BETWEEN :start_date AND :end_date)
                    OR (end_date BETWEEN :start_date AND :end_date)
                    OR (:start_date BETWEEN start_date AND end_date))";
            
            if ($id !== null) {
                $sql .= " AND id != :id";
            }
            
            $stmt = $this->conn->prepare($sql);
            $params = [
                ':comic_id' => $comic_id,
                ':start_date' => date('Y-m-d H:i', $start_date),
                ':end_date' => date('Y-m-d H:i', $end_date)
            ];
            
            if ($id !== null) {
                $params[':id'] = $id;
            }
            
            $stmt->execute($params);
            return $stmt->fetchColumn() > 0;
        } catch (Exception $e) {
            error_log("Error checking existing promotion: " . $e->getMessage());
            return false;
        }
    }
}
?>