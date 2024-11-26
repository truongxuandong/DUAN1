<?php
class DanhMuc
{
    public $conn;
    public function __construct() {
        $this->conn = connectDB();
    }
    public function getAllDanhMuc()
    {
        try {
            $sql = "SELECT * FROM categories ORDER BY name ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
            return [];
        }
    }
    public function layTatCaDanhMuc() {
        try {
            $sql = "SELECT id, name FROM categories";
            $stmt = $this->conn->query($sql); // Đổi từ $this->db thành $this->conn
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }
    
}
?>