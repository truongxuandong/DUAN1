<?php
class ShoppingCart {
    // Thuộc tính kết nối cơ sở dữ liệu (Database Connection)
    public $conn;

    // Constructor: Khởi tạo đối tượng và thiết lập kết nối tới cơ sở dữ liệu
    public function __construct() {
        $this->conn = connectDB(); // Hàm connectDB() trả về một kết nối PDO.
    }

    /**
     * Lấy danh sách các sản phẩm trong giỏ hàng của một người dùng.
     * @param int|null $userId - ID của người dùng, null nếu chưa đăng nhập.
     * @return array - Mảng các sản phẩm trong giỏ hàng.
     */
    public function getCartItems($userId = null) {
        if ($userId === null) {
            return []; // Nếu không có user_id thì trả về mảng rỗng
        }

        $sql = "
            SELECT 
                ci.id AS cart_item_id,        -- ID của từng mục trong giỏ hàng
                c.id AS cart_id,              -- ID giỏ hàng
                ci.comic_id,                  -- ID sản phẩm (truyện)
                ci.quantity,                  -- Số lượng sản phẩm
                ci.unit_price,                -- Giá mỗi đơn vị sản phẩm
                ca.name AS category_name,     -- Tên danh mục của sản phẩm
                co.name AS comic_name         -- Tên sản phẩm
            FROM 
                cart c                        -- Bảng giỏ hàng
            JOIN 
                cart_items ci ON c.id = ci.cart_id -- Liên kết giỏ hàng và mục giỏ hàng
            LEFT JOIN 
                categories ca ON ci.comic_id = ca.id -- Liên kết với bảng danh mục
            LEFT JOIN 
                comics co ON ci.comic_id = co.id   -- Liên kết với bảng sản phẩm (comic)
            WHERE 
                c.user_id = :user_id          -- Lọc theo ID người dùng
        ";

        $stmt = $this->conn->prepare($sql);  // Chuẩn bị truy vấn SQL
        $stmt->execute([':user_id' => $userId]); // Thực thi truy vấn với tham số truyền vào
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về kết quả dưới dạng mảng liên kết
    }

    /**
     * Cập nhật số lượng sản phẩm trong giỏ hàng.
     * @param int $cartItemId - ID của mục giỏ hàng.
     * @param int $comicId - ID sản phẩm.
     * @param int $newQuantity - Số lượng mới của sản phẩm.
     * @return int - Số dòng bị ảnh hưởng trong cơ sở dữ liệu.
     */
    public function updateCartItemQuantity($cartItemId, $comicId, $newQuantity) {
        $sql = "UPDATE cart_items 
                SET quantity = ? 
                WHERE id = ? AND comic_id = ?";
        $stmt = $this->conn->prepare($sql); // Chuẩn bị truy vấn SQL
        $stmt->execute([$newQuantity, $cartItemId, $comicId]); // Thực thi truy vấn
        return $stmt->rowCount(); // Trả về số dòng bị ảnh hưởng
    }

    /**
     * Xóa một sản phẩm khỏi giỏ hàng.
     * @param int $cartItemId - ID của mục giỏ hàng.
     * @return bool - Trả về true nếu xóa thành công, false nếu thất bại.
     */
    public function deleteCartItem($cartItemId) {
        $sql = "DELETE FROM cart_items WHERE id = ?"; // Câu lệnh xóa
        $stmt = $this->conn->prepare($sql); // Chuẩn bị truy vấn
        $result = $stmt->execute([$cartItemId]); // Thực thi truy vấn với tham số

        if ($result) {
            echo "SQL executed successfully"; // Debugging: Xác nhận thực thi thành công
        } else {
            echo "SQL execution failed"; // Debugging: Thông báo lỗi
            print_r($stmt->errorInfo()); // Debugging: Hiển thị thông tin lỗi
        }

        return $result; // Trả về kết quả thực thi (true/false)
    }

    /**
     * Thêm một sản phẩm mới vào giỏ hàng trong cơ sở dữ liệu.
     * @param int $userId ID của người dùng.
     * @param int $comicId ID của sản phẩm (truyện tranh).
     * @param int $quantity Số lượng sản phẩm cần thêm.
     * @return bool Trả về true nếu thêm thành công, false nếu không.
     */
    public function addNewItemToCart($userId, $comicId, $quantity)
    {
        // Kết nối đến cơ sở dữ liệu và thực hiện câu truy vấn.
        $sql = "INSERT INTO cart_items (user_id, comic_id, quantity) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$userId, $comicId, $quantity]);
    }

    /**
     * Hiển thị giỏ hàng của người dùng.
     */
    public function viewShoppingCart()
    {
        // Kiểm tra người dùng đã đăng nhập hay chưa
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        if ($userId === null) {
            // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
            header('Location: login.php');
            exit();
        }

        // Lấy các sản phẩm trong giỏ hàng của người dùng
        $cartItems = $this->getCartItems($userId); // Sử dụng phương thức getCartItems trực tiếp

        // Hiển thị các sản phẩm trong giỏ hàng
        include 'view_cart.php'; // Gọi file view để hiển thị giỏ hàng
    }
}
