<?php
class Order{
    private $conn;
    public function __construct(){
        $this->conn = connectDB();
    }

    public function getAll() {
        try {
            $sql = "SELECT orders.id, orders.user_id, 
                       SUM(order_items.quantity * order_items.unit_price) as total_amount,
                       orders.phone_car,orders.receiver_name, orders.payment_method, orders.payment_status, 
                       orders.shipping_status
                FROM orders
                LEFT JOIN users ON orders.user_id = users.id
                LEFT JOIN order_items ON orders.id = order_items.order_id
                GROUP BY orders.id, orders.user_id, orders.order_date, orders.receiver_name, 
                         orders.payment_method, orders.payment_status, 
                         orders.shipping_status, orders.shipping_address
                ORDER BY orders.order_date DESC";
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

   
    public function getById($id) {
        try {
            $sql = "SELECT orders.id, orders.user_id, orders.phone_car, orders.total_amount, 
                    orders.receiver_name, orders.payment_method, orders.payment_status, 
                    orders.shipping_status, orders.shipping_address
                FROM orders
                LEFT JOIN users ON orders.user_id = users.id
                WHERE orders.id = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function getOrderThongTinKhachHang($id) {
        try {
            $sql = "SELECT orders.id,orders.receiver_name, users.email, orders.phone_car, orders.shipping_address, orders.payment_method
            FROM orders
            JOIN users ON users.id = orders.user_id
            WHERE orders.id = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            $result = $stmt->fetch();
            
            return $result ? $result : null;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function getOrderDetailsThongTin($id) {
        try {
            $sql = "SELECT 
                order_items.order_id,
                order_items.quantity,
                order_items.unit_price,
                (order_items.quantity * order_items.unit_price) AS subtotal,
                comics.title,
                orders.order_date,
                orders.phone_car,
                orders.receiver_name,
                users.email
            FROM order_items
            JOIN comics ON order_items.comic_id = comics.id
            JOIN orders ON order_items.order_id = orders.id
            JOIN users ON orders.user_id = users.id
            WHERE order_items.order_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function updateOrder($data) {
        try {
            // Lấy thông tin đơn hàng hiện tại
            $currentOrder = $this->getById($data[':id']);
            
            // Xử lý trạng thái thanh toán dựa trên trạng thái vận chuyển
            switch ($data[':shipping_status']) {
                case 'delivered':
                    $data[':payment_status'] = 'paid';
                    break;
                case 'cancelled':
                    if ($currentOrder['payment_status'] === 'paid') {
                        $data[':payment_status'] = 'refunded';
                    }
                    break;
                case 'returned':
                    // Nếu đơn hàng đã thanh toán và bị trả lại, cập nhật trạng thái thành hoàn tiền
                    if ($currentOrder['payment_status'] === 'paid') {
                        $data[':payment_status'] = 'refunded';
                    }
                    break;
            }

            
            
            $sql = "UPDATE orders SET 
                    
                    shipping_status = :shipping_status,
                    payment_status = :payment_status
                    WHERE id = :id";

            $stmt = $this->conn->prepare($sql);
            return $stmt->execute($data);
        } catch (PDOException $e) {
            echo "Update failed: " . $e->getMessage();
            return false;
        }
    }

    

}
?>