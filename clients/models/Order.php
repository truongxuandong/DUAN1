<?php
class OrderModel {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function createOrder($data) {
        try {
            $sql = "INSERT INTO orders (user_id, total_amount, payment_method, shipping_address, payment_status) 
                    VALUES (:user_id, :total_amount, :payment_method, :shipping_address, :payment_status)";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':user_id' => $data['user_id'],
                ':total_amount' => $data['total_amount'],
                ':payment_method' => $data['payment_method'],
                ':shipping_address' => $data['shipping_address'],
                ':payment_status' => $data['payment_status']
            ]);

            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Lỗi khi tạo đơn hàng: " . $e->getMessage());
        }
    }

    public function addOrderItem($data) {
        try {
            $sql = "INSERT INTO order_items (order_id, comic_id, quantity, unit_price) 
                    VALUES (:order_id, :comic_id, :quantity, :unit_price)";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':order_id' => $data['order_id'],
                ':comic_id' => $data['comic_id'],
                ':quantity' => $data['quantity'],
                ':unit_price' => $data['unit_price']
            ]);

            // Cập nhật số lượng tồn kho
            $sql = "UPDATE comics SET stock_quantity = stock_quantity - :quantity 
                    WHERE id = :comic_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':quantity' => $data['quantity'],
                ':comic_id' => $data['comic_id']
            ]);
        } catch (PDOException $e) {
            throw new Exception("Lỗi khi thêm sản phẩm vào đơn hàng: " . $e->getMessage());
        }
    }

    public function getOrderById($orderId) {
        try {
            $sql = "SELECT o.*, u.fullname, u.email, u.phone 
                    FROM orders o 
                    JOIN users u ON o.user_id = u.id 
                    WHERE o.id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$orderId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Lỗi khi lấy thông tin đơn hàng: " . $e->getMessage());
        }
    }

    public function getOrderItems($orderId) {
        try {
            $sql = "SELECT oi.*, c.title, c.image 
                    FROM order_items oi 
                    JOIN comics c ON oi.comic_id = c.id 
                    WHERE oi.order_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$orderId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Lỗi khi lấy chi tiết đơn hàng: " . $e->getMessage());
        }
    }
}