<?php
class Thongke{
    private $conn;
    public function __construct(){
        $this->conn = connectDB();
    }
    public function getTotalPrice(){
        try{
            $sql = "SELECT 
                        SUM(o.total_amount) AS total
                    FROM 
                        Orders o
                    WHERE 
                        o.shipping_status = 'delivered';
                    ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function getTotalProduct(){
        try{
            $sql = "SELECT COUNT(*) AS total FROM comics";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function getTotalUser(){
        try{
            $sql = "SELECT COUNT(*) AS total FROM users WHERE role = 'user'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
     
        }
    }
    public function getTotalOrder(){
        try{
            $sql = "SELECT COUNT(*) AS total FROM orders WHERE shipping_status = 'delivered'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function countOrdersByDate($date){
        try {
            $sql = "SELECT COUNT(*) AS total 
                   FROM orders 
                   WHERE shipping_status = 'delivered' 
                   AND DATE(order_date) = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$date]);
            return $stmt->fetchColumn();
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return 0;
        }
    }
    public function getRevenueByDate($date){
        try {
            $sql = "SELECT COALESCE(SUM(total_amount), 0) AS total 
                   FROM orders 
                   WHERE shipping_status = 'delivered' 
                   AND DATE(order_date) = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$date]);
            return $stmt->fetchColumn();
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return 0;
        }
    }
    public function countProductsSoldByDate($date){
        try {
            $sql = "SELECT COALESCE(SUM(oi.quantity), 0) AS total 
                   FROM order_items oi
                   JOIN orders o ON oi.order_id = o.id 
                   WHERE o.shipping_status = 'delivered' 
                   AND DATE(o.order_date) = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$date]);
            return $stmt->fetchColumn();
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return 0;
        }
    }
    public function getMonthlyRevenue($year){
        try {
            $sql = "SELECT MONTH(order_date) AS month, 
                          COALESCE(SUM(total_amount), 0) AS total 
                   FROM orders 
                   WHERE shipping_status = 'delivered' 
                   AND YEAR(order_date) = ? 
                   GROUP BY MONTH(order_date)
                   ORDER BY month";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$year]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return [];
        }
    }



    // thang
    public function countOrdersByDateRange($month, $year) {
        try {
            $sql = "SELECT COUNT(*) as total FROM orders 
                    WHERE MONTH(order_date) = ? AND YEAR(order_date) = ?
                    AND shipping_status = 'delivered'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$month, $year]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return 0;
        }
    }
    
    public function sumRevenueByDateRange($month, $year) {
        try {
            $sql = "SELECT SUM(total_amount) as total FROM orders 
                    WHERE MONTH(order_date) = ? AND YEAR(order_date) = ?
                    AND shipping_status = 'delivered'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$month, $year]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return 0;
        }
    }
    
    public function countProductsSoldByDateRange($month, $year) {
        try {
            $sql = "SELECT SUM(oi.quantity) as total 
                    FROM order_items oi 
                    JOIN orders o ON oi.order_id = o.id 
                    WHERE MONTH(o.order_date) = ? AND YEAR(o.order_date) = ?
                    AND o.shipping_status = 'delivered'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$month, $year]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return 0;
        }
    }

    public function getDailyRevenue($days = 7) {
        try {
            $sql = "SELECT DATE(order_date) as date, 
                           COALESCE(SUM(total_amount), 0) as total
                    FROM orders 
                    WHERE shipping_status = 'delivered' 
                    AND order_date >= DATE_SUB(CURRENT_DATE, INTERVAL ? DAY)
                    GROUP BY DATE(order_date)
                    ORDER BY date";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$days]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return [];
        }
    }
}

?>