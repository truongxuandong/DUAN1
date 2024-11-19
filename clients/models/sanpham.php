<?php
class SanPham
{
    public $conn;
    public function __construct() {
        $this->conn = connectDB();
    }
    public function getAllSanPham()
    {
        try {
            $sql = "SELECT * FROM comics ORDER BY id ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
            return [];
        }
    }
    
    public function getSanPhamById($id)
    {
        try {
            $sql = "SELECT * FROM comics WHERE id = $id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
            return [];
        }
    }
    
}
?>