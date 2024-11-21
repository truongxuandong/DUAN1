<?php
class Order{
    private $conn;
    public function __construct(){
        $this->conn = connectDB();
    }

    public function getAll() {
        try {
            $sql = "SELECT orders.id, orders.user_id, orders.order_date, 
                       SUM(order_items.quantity * order_items.unit_price) as total_products_amount,
                       users.name, orders.payment_method, orders.payment_status, 
                       orders.shipping_status, orders.shipping_address
                FROM orders
                LEFT JOIN users ON orders.user_id = users.id
                LEFT JOIN order_items ON orders.id = order_items.order_id
                GROUP BY orders.id, orders.user_id, orders.order_date, users.name, 
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

    public function deleteorder($id){
        try {
            $sql = 'DELETE FROM orders WHERE id=:id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id'=>$id]);
            return true;
        }catch (Exception $e){
            echo "lỗi" .$e->getMessage();
        }
    }
    public function getById($id) {
        try {
            $sql = "SELECT orders.id, orders.user_id, orders.order_date, orders.total_amount, 
                    users.name, orders.payment_method, orders.payment_status, 
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
            $sql = "SELECT users.name, users.email, users.phone, orders.shipping_address, orders.payment_method
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
                users.name,
                users.email,
                users.phone
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
            $sql = "UPDATE orders SET 
                    total_amount = :total_amount,
                    payment_status = :payment_status,
                    shipping_status = :shipping_status,
                    payment_method = :payment_method,
                    shipping_address = :shipping_address
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