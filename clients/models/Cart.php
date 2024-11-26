<?php
class Cart
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();  // Giả sử hàm connectDB() đã được định nghĩa để kết nối với cơ sở dữ liệu
    }

    // Lấy giỏ hàng của người dùng
    public function getCart($userId)
    {
        try {
            $sql = "SELECT * FROM cart WHERE user_id = :user_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetch();  // Trả về giỏ hàng của người dùng nếu tồn tại
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Tạo giỏ hàng mới cho người dùng
    public function createCart($userId)
    {
        try {
            $sql = "INSERT INTO cart (user_id) VALUES (:user_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
            return $this->conn->lastInsertId();  // Trả về ID giỏ hàng vừa tạo
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Lấy tất cả các sản phẩm trong giỏ hàng
    public function getCartItems($cartId)
    {
        try {
            $sql = "SELECT ci.id, ci.quantity, ci.unit_price, c.name AS comic_name
                    FROM cart_items ci
                    JOIN comics c ON ci.comic_id = c.id
                    WHERE ci.cart_id = :cart_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([ ':cart_id' => $cartId ]);
            return $stmt->fetchAll();  // Trả về tất cả các sản phẩm trong giỏ hàng
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addProductToCart($cartId, $comicId, $quantity, $unitPrice)
    {
        try {
            // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
            $sql = "SELECT * FROM cart_items WHERE cart_id = :cart_id AND comic_id = :comic_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([ ':cart_id' => $cartId, ':comic_id' => $comicId ]);
            $item = $stmt->fetch();

            if ($item) {
                // Nếu có, cập nhật số lượng
                $newQuantity = $item['quantity'] + $quantity;
                $sql = "UPDATE cart_items SET quantity = :quantity WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([ ':quantity' => $newQuantity, ':id' => $item['id'] ]);
            } else {
                // Nếu chưa có, thêm mới sản phẩm vào giỏ
                $sql = "INSERT INTO cart_items (cart_id, comic_id, quantity, unit_price) 
                        VALUES (:cart_id, :comic_id, :quantity, :unit_price)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([
                    ':cart_id' => $cartId,
                    ':comic_id' => $comicId,
                    ':quantity' => $quantity,
                    ':unit_price' => $unitPrice
                ]);
            }
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateProductQuantity($cartItemId, $quantity)
    {
        try {
            $sql = "UPDATE cart_items SET quantity = :quantity WHERE id = :cart_item_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([ ':quantity' => $quantity, ':cart_item_id' => $cartItemId ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeProductFromCart($cartItemId)
    {
        try {
            $sql = "DELETE FROM cart_items WHERE id = :cart_item_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([ ':cart_item_id' => $cartItemId ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}
?>
