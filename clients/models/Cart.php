<?php
class CartModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
        $this->addVariantIdColumn();
    }

    private function addVariantIdColumn()
    {
        try {
            // Kiểm tra xem cột đã tồn tại chưa
            $sql = "SHOW COLUMNS FROM cart_items LIKE 'variant_id'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            
            if ($stmt->rowCount() == 0) {
                // Thêm cột variant_id nếu chưa tồn tại
                $sql = "ALTER TABLE `cart_items`
                       ADD COLUMN `variant_id` int DEFAULT NULL,
                       ADD CONSTRAINT `cart_items_variant_fk` 
                       FOREIGN KEY (`variant_id`) REFERENCES `comic_variants` (`id`) 
                       ON DELETE SET NULL ON UPDATE CASCADE";
                $this->conn->exec($sql);
            }
        } catch (PDOException $e) {
            error_log("Error adding variant_id column: " . $e->getMessage());
        }
    }

    public function getCartItems($userId)
    {
        $sql = "SELECT ci.*, c.title, c.price, c.image, c.stock_quantity,
                       cv.format, cv.language, cv.price as variant_price, 
                       cv.stock_quantity as variant_stock
                FROM cart_items ci 
                JOIN comics c ON ci.comic_id = c.id 
                LEFT JOIN comic_variants cv ON ci.variant_id = cv.id
                WHERE ci.cart_id IN (SELECT id FROM cart WHERE user_id = ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function addItem($userId, $comicId, $quantity, $variantId = null)
    {
        try {
            // Kiểm tra giá và tồn kho
            if ($variantId !== null) {
                // Kiểm tra biến thể
                $sql = "SELECT price, stock_quantity FROM comic_variants WHERE id = ? AND comic_id = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$variantId, $comicId]);
                $product = $stmt->fetch();
                
                if (!$product || $quantity > $product['stock_quantity']) {
                    return false;
                }
                $price = $product['price'];
            } else {
                // Kiểm tra sản phẩm gốc
                $sql = "SELECT price, stock_quantity FROM comics WHERE id = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$comicId]);
                $product = $stmt->fetch();
                
                if (!$product || $quantity > $product['stock_quantity']) {
                    return false;
                }
                $price = $product['price'];
            }

            $cartId = $this->getOrCreateCart($userId);

            // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng
            $sql = "SELECT id, quantity FROM cart_items 
                    WHERE cart_id = ? AND comic_id = ? 
                    AND (variant_id = ? OR (variant_id IS NULL AND ? IS NULL))";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$cartId, $comicId, $variantId, $variantId]);
            $existingItem = $stmt->fetch();

            if ($existingItem) {
                // Cập nhật số lượng nếu đã tồn tại
                $newQuantity = $existingItem['quantity'] + $quantity;
                if ($variantId !== null) {
                    if ($newQuantity > $product['stock_quantity']) {
                        return false;
                    }
                } else {
                    if ($newQuantity > $product['stock_quantity']) {
                        return false;
                    }
                }
                
                $sql = "UPDATE cart_items SET quantity = ? WHERE id = ?";
                $stmt = $this->conn->prepare($sql);
                return $stmt->execute([$newQuantity, $existingItem['id']]);
            } else {
                // Thêm mới nếu chưa tồn tại
                $sql = "INSERT INTO cart_items (cart_id, comic_id, variant_id, quantity, unit_price) 
                        VALUES (?, ?, ?, ?, ?)";
                $stmt = $this->conn->prepare($sql);
                return $stmt->execute([$cartId, $comicId, $variantId, $quantity, $price]);
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    private function getOrCreateCart($userId)
    {
        $sql = "SELECT id FROM cart WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$userId]);
        $cart = $stmt->fetch();

        if ($cart) {
            return $cart['id'];
        }

        $sql = "INSERT INTO cart (user_id) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$userId]);
        return $this->conn->lastInsertId();
    }

    public function updateQuantity($itemId, $quantity, $userId)
    {
        $sql = "UPDATE cart_items ci 
                JOIN cart c ON ci.cart_id = c.id 
                SET ci.quantity = ? 
                WHERE ci.id = ? AND c.user_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$quantity, $itemId, $userId]);
    }

    public function removeItem($itemId, $userId)
    {
        $sql = "DELETE ci FROM cart_items ci 
                JOIN cart c ON ci.cart_id = c.id 
                WHERE ci.id = ? AND c.user_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$itemId, $userId]);
    }

    public function getCartTotal($userId)
    {
        $sql = "SELECT SUM(ci.quantity * c.price) as total 
                FROM cart_items ci 
                JOIN comics c ON ci.comic_id = c.id 
                JOIN cart ca ON ci.cart_id = ca.id 
                WHERE ca.user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$userId]);
        $result = $stmt->fetch();
        return $result['total'] ?? 0;
    }

    public function deleteCart($userId)
    {
        // Xóa cart_items trước
        $sql = "DELETE ci FROM cart_items ci 
                JOIN cart c ON ci.cart_id = c.id 
                WHERE c.user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$userId]);

        // Sau đó xóa cart
        $sql = "DELETE FROM cart WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$userId]);
    }

    public function hasVariants($comicId) 
    {
        $sql = "SELECT COUNT(*) FROM comic_variants WHERE comic_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$comicId]);
        return $stmt->fetchColumn() > 0;
    }

    public function isValidVariant($comicId, $variantId) 
    {
        $sql = "SELECT COUNT(*) FROM comic_variants 
                WHERE id = ? AND comic_id = ? AND stock_quantity > 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$variantId, $comicId]);
        return $stmt->fetchColumn() > 0;
    }
}
