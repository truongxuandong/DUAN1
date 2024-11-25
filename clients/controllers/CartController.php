<?php
class ShoppingCartController
{
    // Thuộc tính đại diện cho đối tượng ShoppingCart, chịu trách nhiệm thao tác với cơ sở dữ liệu.
    public $ShoppingCart;

    // Hàm khởi tạo: Tự động gọi khi tạo đối tượng của lớp này.
    public function __construct()
    {
        // Tạo một thể hiện của lớp ShoppingCart để sử dụng trong các phương thức khác.
        $this->ShoppingCart = new ShoppingCart();
    }

    /**
     * Hiển thị giỏ hàng bằng cách tải file giao diện (view).
     * Tệp `listCart.php` sẽ sử dụng các dữ liệu từ phương thức khác (như getCartItems) để hiển thị thông tin.
     */
    public function view_shoppingCart()
    {
        require_once './views/giohang/listCart.php';
    }

    /**
     * Lấy danh sách các sản phẩm trong giỏ hàng từ cơ sở dữ liệu.
     * @param int $userId ID của người dùng (nếu có).
     * @return array Mảng chứa thông tin sản phẩm trong giỏ hàng.
     */
    public function getCartItems($userId)
    {
        // Gọi phương thức của lớp ShoppingCart để lấy dữ liệu giỏ hàng từ cơ sở dữ liệu.
        $cartItems = $this->ShoppingCart->getCartItems($userId);

        // Trả về danh sách sản phẩm trong giỏ hàng (một mảng các sản phẩm).
        return $cartItems;
    }

    /**
     * Cập nhật số lượng sản phẩm trong giỏ hàng (tăng hoặc giảm).
     * Hành động được thực hiện dựa trên yêu cầu từ form gửi qua POST.
     */
    public function updateQuantity()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy ID của sản phẩm từ form.
            $comicId = intval($_POST['comic_id']);
            // Lấy hành động từ form (increase hoặc decrease).
            $action = $_POST['action'];
            // Lấy ID người dùng từ phiên (session), nếu có.
            $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

            // Kiểm tra ID sản phẩm hợp lệ
            if ($comicId > 0) {
                // Lấy danh sách sản phẩm trong giỏ hàng của người dùng.
                $cartItems = $this->ShoppingCart->getCartItems($userId);

                // Duyệt qua từng sản phẩm để tìm sản phẩm cần cập nhật.
                foreach ($cartItems as $item) {
                    if ($item['comic_id'] == $comicId) {
                        // Tính toán số lượng mới dựa trên hành động.
                        $newQuantity = ($action === 'increase')
                            ? $item['quantity'] + 1
                            : max($item['quantity'] - 1, 1);

                        // Lấy ID của sản phẩm trong giỏ hàng.
                        $cartItemId = $item['cart_item_id'];

                        // Cập nhật số lượng trong cơ sở dữ liệu.
                        $this->ShoppingCart->updateCartItemQuantity($cartItemId, $comicId, $newQuantity);
                        break;
                    }
                }
            }

            // Sau khi cập nhật, chuyển hướng về trang giỏ hàng.
            header('Location: ?act=view-shopping-cart');
        }
    }

    /**
     * Xóa một sản phẩm khỏi giỏ hàng.
     * Thực hiện dựa trên `cart_item_id` được gửi qua GET.
     */
    public function deleteItem()
    {
        // Kiểm tra nếu ID sản phẩm cần xóa được truyền qua URL.
        if (isset($_GET['cart_item_id'])) {
            // Chuyển đổi ID về kiểu số nguyên.
            $cartItemId = intval($_GET['cart_item_id']);

            // Gọi phương thức xóa sản phẩm từ lớp ShoppingCart.
            if ($this->ShoppingCart->deleteCartItem($cartItemId)) {
                echo "Item deleted successfully"; // Thông báo (dùng để debug).
            } else {
                echo "Failed to delete item"; // Thông báo lỗi (dùng để debug).
            }
        } else {
            echo "cart_item_id not set"; // Thông báo nếu ID không được cung cấp (dùng để debug).
        }

        // Chuyển hướng về trang giỏ hàng sau khi xử lý.
        header('Location: ?act=view-shopping-cart');
        exit();
    }
    /**
     * Thêm sản phẩm vào giỏ hàng.
     */
    public function addItemToCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Kiểm tra sự tồn tại của comic_id trong dữ liệu POST
            if (!isset($_POST['comic_id']) || empty($_POST['comic_id'])) {
                die('Error: Missing comic_id in the request.');
            }
    
            // Lấy ID của sản phẩm và số lượng từ form
            $comicId = intval($_POST['comic_id']);
            $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    
            // Lấy ID người dùng từ phiên (session), nếu có
            $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    
            // Kiểm tra ID sản phẩm và số lượng hợp lệ
            if ($comicId > 0 && $quantity > 0 && $userId !== null) {
                // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng hay chưa
                $cartItems = $this->ShoppingCart->getCartItems($userId);
    
                $itemExists = false;
                foreach ($cartItems as $item) {
                    if ($item['comic_id'] == $comicId) {
                        $itemExists = true;
                        $newQuantity = $item['quantity'] + $quantity;
    
                        // Cập nhật số lượng nếu sản phẩm đã tồn tại
                        $this->ShoppingCart->updateCartItemQuantity($item['cart_item_id'], $comicId, $newQuantity);
                        break;
                    }
                }
    
                // Nếu sản phẩm chưa tồn tại, thêm sản phẩm mới
                if (!$itemExists) {
                    $this->ShoppingCart->addNewItemToCart($userId, $comicId, $quantity);
                }
            }
    
            // Sau khi thêm sản phẩm, chuyển hướng về trang giỏ hàng
            header('Location: ?act=view-shopping-cart');
            exit(); // Đảm bảo dừng mã sau khi chuyển hướng
        }
    }
    
    }
