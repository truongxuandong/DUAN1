<?php
class CheckoutController {
    private $cartModel;
    private $orderModel;
    
    public function __construct() {
        $this->cartModel = new CartModel();
        $this->orderModel = new OrderModel();
    }

    public function index() {
        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = "Vui lòng đăng nhập để thanh toán";
            header('Location: ?act=login');
            exit;
        }

        $userId = $_SESSION['user']['id'];
        
        // Xử lý mua ngay
        if (isset($_POST['buy_now']) && $_POST['buy_now'] == 1) {
            $buyNowItem = [
                'comic_id' => $_POST['comic_id'],
                'quantity' => $_POST['quantity'],
                'price' => $_POST['price'],
                'title' => $_POST['title'],
                'image' => $_POST['image'],
                'total_amount' => $_POST['price'] * $_POST['quantity']
            ];
            
            $_SESSION['buy_now_item'] = $buyNowItem;
            require_once './clients/views/checkout/thanhtoan.php';
            return;
        }

        // Xử lý giỏ hàng thông thường
        $cartItems = $this->cartModel->getCartItems($userId);
        if (empty($cartItems)) {
            $_SESSION['error'] = "Giỏ hàng trống";
            header('Location: ?act=view-shopping-cart');
            exit;
        }
        
        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        require_once './clients/views/checkout/thanhtoan.php';
    }

    public function processCheckout() {
        try {
            if (!isset($_SESSION['user'])) {
                throw new Exception("Vui lòng đăng nhập để thanh toán");
            }

            $userId = $_SESSION['user']['id'];
            $address = $_POST['shipping_address'] ?? '';
            $paymentMethod = $_POST['payment_method'] ?? '';
            $receiverName = $_POST['receiver_name'] ?? '';
            $phone = $_POST['phone_car'] ?? '';
            
            if (empty($address) || empty($paymentMethod) || empty($receiverName) || empty($phone)) {
                throw new Exception("Vui lòng điền đầy đủ thông tin");
            }

            // Xử lý đơn hàng mua ngay
            if (isset($_SESSION['buy_now_item'])) {
                $item = $_SESSION['buy_now_item'];
                
                // Tạo đơn hàng mới
                $orderData = [
                    'user_id' => $userId,
                    'total_amount' => $item['total_amount'],
                    'payment_method' => $paymentMethod,
                    'shipping_address' => $address,
                    'payment_status' => 'Chờ xác nhận',
                    'receiver_name' => $receiverName,
                    'phone_car' => $phone,
                    'order_date' => date('Y-m-d H:i:s')
                ];

                $orderId = $this->orderModel->createOrder($orderData);

                // Thêm chi tiết đơn hàng
                $orderItemData = [
                    'order_id' => $orderId,
                    'comic_id' => $item['comic_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                    'title' => $item['title'],
                    'image' => $item['image']
                ];
                
                $this->orderModel->addOrderItem($orderItemData);

                // Xóa session mua ngay
                unset($_SESSION['buy_now_item']);

                $_SESSION['success'] = "Đặt hàng thành công!";
                header('Location: ?act=order-success&id=' . $orderId);
                exit;
            }else {
                // Xử lý đơn hàng từ giỏ hàng
                $cartItems = $this->cartModel->getCartItems($userId);
                $totalAmount = 0;
                foreach ($cartItems as $item) {
                    $totalAmount += $item['price'] * $item['quantity'];
                }

                // Tạo đơn hàng
                $orderData = [
                    'user_id' => $userId,
                    'total_amount' => $totalAmount,
                    'payment_method' => $paymentMethod,
                    'shipping_address' => $address,
                    'payment_status' => 'processing',
                    'receiver_name' => $receiverName,
                    'phone_car' => $phone
                ];

                $orderId = $this->orderModel->createOrder($orderData);

                // Thêm chi tiết đơn hàng
                foreach ($cartItems as $item) {
                    $orderItemData = [
                        'order_id' => $orderId,
                        'comic_id' => $item['comic_id'],
                        'quantity' => $item['quantity'],
                        'unit_price' => $item['price']
                    ];
                    $this->orderModel->addOrderItem($orderItemData);
                }
            }

            // Xóa giỏ hàng
            $this->cartModel->deleteCart($userId);

            $_SESSION['success'] = "Đặt hàng thành công!";
            header('Location: ?act=order-success&id=' . $orderId);

        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: ?act=checkout');
            exit;
        }
    }

    public function orderSuccess() {
        if (!isset($_GET['id'])) {
            header('Location: index.php');
            exit;
        }

        $orderId = $_GET['id'];
        $order = $this->orderModel->getOrderById($orderId);
        
        if (!$order) {
            header('Location: index.php');
            exit;
        }

        // Lấy chi tiết đơn hàng
        $orderItems = $this->orderModel->getOrderItems($orderId);
        
        require_once 'clients/views/checkout/order-success.php';
    }
}
