<?php
ob_start();
require_once '../commons/core.php';

class CartController
{
    private $modelCart;

    public function __construct()
    {
        $this->modelCart = new Cart(); // Khởi tạo model Cart
    }

    // Hiển thị giỏ hàng của người dùng
    public function showCart()
    {
        session_start(); // Bắt đầu phiên làm việc

        // Kiểm tra nếu user chưa đăng nhập (chưa có session 'user_id')
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Bạn cần đăng nhập để xem giỏ hàng!";
            header("Location: login.php");  // Chuyển hướng đến trang đăng nhập
            exit(); // Dừng chương trình sau khi chuyển hướng
        }

        $userId = $_SESSION['user_id'];  // Lấy user_id từ session

        // Gọi model để lấy giỏ hàng của người dùng
        $listCart = $this->modelCart->getCart($userId);

        // Kiểm tra xem giỏ hàng có tồn tại không
        if (!$listCart) {
            $_SESSION['error'] = "Giỏ hàng của bạn hiện tại trống.";
        }

        // Load view giỏ hàng
        require_once './clients/views/giohang/listCart.php';
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addToCart()
    {
        session_start(); // Đảm bảo session được bắt đầu

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user_id'])) {
                $_SESSION['error'] = "Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!";
                header("Location: login.php");  // Chuyển hướng đến trang đăng nhập
                exit(); // Dừng chương trình sau khi chuyển hướng
            }

            $userId = $_SESSION['user_id']; // Giả sử user_id được lưu trong session
            $comicId = $_POST['comic_id'];
            $quantity = $_POST['quantity'];
            $unitPrice = $_POST['unit_price'];

            // Kiểm tra xem người dùng đã có giỏ hàng chưa
            $cart = $this->modelCart->getCart($userId);
            if (!$cart) {
                // Nếu chưa có giỏ hàng, tạo mới
                $cartId = $this->modelCart->createCart($userId);
            } else {
                $cartId = $cart['id'];
            }

            // Thêm sản phẩm vào giỏ hàng
            if ($this->modelCart->addProductToCart($cartId, $comicId, $quantity, $unitPrice)) {
                $_SESSION['success'] = "Thêm sản phẩm vào giỏ hàng thành công!";
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng!";
            }

            // Chuyển hướng về giỏ hàng
            header("Location: " . BASE_URL . "?act=show-cart");
            exit(); // Dừng chương trình sau khi redirect
        }
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateCart()
    {
        session_start(); // Đảm bảo session được bắt đầu

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user_id'])) {
                $_SESSION['error'] = "Bạn cần đăng nhập để cập nhật giỏ hàng!";
                header("Location: login.php");  // Chuyển hướng đến trang đăng nhập
                exit(); // Dừng chương trình sau khi chuyển hướng
            }

            $cartItemId = $_POST['cart_item_id'];
            $quantity = $_POST['quantity'];

            if ($this->modelCart->updateProductQuantity($cartItemId, $quantity)) {
                $_SESSION['success'] = "Cập nhật số lượng sản phẩm thành công!";
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra khi cập nhật số lượng sản phẩm!";
            }

            // Chuyển hướng về giỏ hàng sau khi cập nhật
            header("Location: " . BASE_URL . "?act=show-cart");
            exit(); // Dừng chương trình sau khi redirect
        }
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart()
    {
        session_start(); // Đảm bảo session được bắt đầu

        if (isset($_GET['cart_item_id'])) {
            if (!isset($_SESSION['user_id'])) {
                $_SESSION['error'] = "Bạn cần đăng nhập để xóa sản phẩm khỏi giỏ hàng!";
                header("Location: login.php");  // Chuyển hướng đến trang đăng nhập
                exit(); // Dừng chương trình sau khi chuyển hướng
            }

            $cartItemId = $_GET['cart_item_id'];

            if ($this->modelCart->removeProductFromCart($cartItemId)) {
                $_SESSION['success'] = "Xóa sản phẩm khỏi giỏ hàng thành công!";
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra khi xóa sản phẩm!";
            }

            // Chuyển hướng về giỏ hàng sau khi xóa
            header("Location: " . BASE_URL . "show-cart");
            exit(); // Dừng chương trình sau khi redirect
        }
    }
}

ob_end_flush(); // Kết thúc buffer output
?>
