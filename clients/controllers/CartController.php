<?php
class CartController
{
    private $cartModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
    }

    // 1. Thêm sản phẩm vào giỏ hàng
    public function addToCart()
    {
        if (!isset($_SESSION['user_id']) || !isset($_POST['comic_id']) || !isset($_POST['quantity'])) {
            $_SESSION['error'] = 'Yêu cầu không hợp lệ!';
            header('Location:?act=view-shopping-cart');
            return;
        }

        $userId = $_SESSION['user_id'];
        $comicId = (int)$_POST['comic_id'];
        $quantity = (int)$_POST['quantity'];
        $variantId = !empty($_POST['variant_id']) ? (int)$_POST['variant_id'] : null;

        if ($variantId !== null) {
            if (!$this->cartModel->isValidVariant($comicId, $variantId)) {
                $_SESSION['error'] = 'Phiên bản sản phẩm không hợp lệ!';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                return;
            }
        }

        if ($this->cartModel->addItem($userId, $comicId, $quantity, $variantId)) {
            $_SESSION['message'] = 'Thêm vào giỏ hàng thành công!';
        } else {
            $_SESSION['error'] = 'Không thể thêm vào giỏ hàng!';
        }

        header('Location: ?act=view-shopping-cart');
        exit();
    }

    // 2. Xem giỏ hàng
    public function view_shoppingCart()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?act=login');
            return;
        }
        
        $userId = $_SESSION['user_id'];
        $cartItems = $this->cartModel->getCartItems($userId);
        $totalAmount = $this->cartModel->getCartTotal($userId);
        
        include 'clients/views/giohang/listCart.php';
    }

    // 3. Cập nhật số lượng sản phẩm
    public function updateQuantity()
    {
        if (!isset($_SESSION['user_id']) || !isset($_POST['item_id']) || !isset($_POST['quantity'])) {
            $_SESSION['error'] = 'Yêu cầu không hợp lệ!';
            header('Location: ?act=view-shopping-cart');
            return;
        }

        $itemId = (int)$_POST['item_id'];
        $quantity = (int)$_POST['quantity'];
        $userId = $_SESSION['user_id'];

        if ($this->cartModel->updateQuantity($itemId, $quantity, $userId)) {
            $_SESSION['message'] = 'Cập nhật số lượng thành công!';
        } else {
            $_SESSION['error'] = 'Không thể cập nhật số lượng!';
        }

        header('Location: ?act=view-shopping-cart');
        exit();
    }

    // 4. Xóa sản phẩm khỏi giỏ hàng
    public function deleteItem()
    {
        if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
            $_SESSION['error'] = 'Yêu cầu không hợp lệ!';
            header('Location: ?act=view-shopping-cart');
            return;
        }
    
        $itemId = (int)$_GET['id'];
        $userId = $_SESSION['user_id'];
    
        if ($this->cartModel->removeItem($itemId, $userId)) {
            $_SESSION['message'] = 'Xóa sản phẩm thành công!';
        } else {
            $_SESSION['error'] = 'Không thể xóa sản phẩm!';
        }
    
        header('Location: ?act=view-shopping-cart');
        exit();
    }
}