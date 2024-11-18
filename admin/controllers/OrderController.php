<?php
class OrderController{
    private $modelOrder;
    private $modelUser;
    

    public function __construct(){
        $this->modelOrder = new Order();
        $this->modelUser = new User();

    }
    public function views_order() {
        $orders=$this->modelOrder->getAll();
        require_once './views/order/listdonhang.php';
    }

    public function deleteorder() {
        if ($this->modelOrder->deleteorder($_GET['id'])) {
            $_SESSION['success'] = "Xóa đơn hàng thành công";
        } else {
            $_SESSION['error'] = "Xóa đơn hàng thất bại";
        }
        header('Location: ?act=order');
        exit;
    }
    public function views_edit_order() {
        $order = $this->modelOrder->getById($_GET['id']);
        require_once './views/order/editorder.php';
    }

    public function views_post_edit_order() {
        if (isset($_POST)) {
            $data = [
                ':id' => $_POST['id'],
                ':total_amount' => $_POST['total_amount'],
                ':payment_status' => $_POST['payment_status'],
                ':shipping_status' => $_POST['shipping_status'],
                ':payment_method' => $_POST['payment_method'],
                ':shipping_address' => $_POST['shipping_address']
            ];

            try {
                
                $this->validateOrderUpdate($data);
                
                if ($this->modelOrder->updateOrder($data)) {
                    $_SESSION['success'] = "Cập nhật đơn hàng thành công";
                } else {
                    $_SESSION['error'] = "Cập nhật đơn hàng thất bại";
                }
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
            }
        }
        header('Location: ?act=order');
        exit;
    }

    private function validateOrderUpdate($data) {
        $currentOrder = $this->modelOrder->getById($data[':id']);

        if($currentOrder['payment_method'] === 'Credit Card' || $currentOrder['payment_method'] === 'Internet Banking' || $currentOrder['payment_method'] === 'E-Wallet'){
            if($currentOrder['payment_status'] === 'failed'){
                if (!in_array($data[':payment_status'], ['processing', 'cancelled'])) {
                    throw new Exception("Đơn hàng đã thất bại thanh toán chỉ có thể được xử lý lại hoặc hủy bỏ");
                }
            }
           
            
            
            $allowedStatuses = ['processing', 'paid', 'refunded', 'failed'];
            if (!in_array($data[':payment_status'], $allowedStatuses)) {
                throw new Exception("Trạng thái thanh toán không hợp lệ cho phương thức thanh toán điện tử");
            }
            
           
            if (empty($data[':payment_status'])) {
                $data[':payment_status'] = 'processing';
            }
        }
        
        if ($currentOrder['shipping_status'] !== 'pending' && 
            $currentOrder['payment_status'] !== 'processing') {
            if ($data[':shipping_address'] !== $currentOrder['shipping_address']) {
                throw new Exception("Không thể thay đổi địa chỉ giao hàng sau khi đơn hàng đã được xử lý");
            }
        }

        
        if ($currentOrder['shipping_status'] === 'delivering') {
            if ($data[':shipping_status'] === 'cancelled') {
                throw new Exception("Không thể hủy đơn hàng đang trong quá trình giao");
            }
            
           
            if ($data[':payment_method'] !== $currentOrder['payment_method'] ||
                $data[':total_amount'] !== $currentOrder['total_amount']) {
                throw new Exception("Không thể thay đổi thông tin đơn hàng khi đang trong quá trình giao");
            }
        }

        
        if ($data[':payment_method'] === 'Cash on Delivery') {
            if ($data[':payment_status'] === 'paid' && 
                $data[':shipping_status'] !== 'delivered') {
                throw new Exception("COD chỉ có thể được đánh dấu thanh toán khi đã giao hàng");
            }
        }

        
        if ($data[':payment_status'] === 'refunded' && 
            $data[':shipping_status'] !== 'returned') {
            throw new Exception("Chỉ có thể hoàn tiền khi đơn hàng đã được trả lại");
        }

         
        if ($data[':shipping_status'] === 'cancelled' && 
            $currentOrder['shipping_status'] === 'delivered') {
            throw new Exception("Không thể hủy đơn hàng đã giao thành công");
        }
    }

    public function views_order_detail() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = "Không tìm thấy đơn hàng ";
            header('Location: ?act=order');
            exit;
        }

        $order = $this->modelOrder->getOrderThongTinKhachHang($id);
        
        $detailsp = $this->modelOrder->getOrderDetailsThongTin($id);
        
        
        if (!$order || !$detailsp) {
            $_SESSION['error'] = "Không tìm thấy thông tin đơn hàng id";
            header('Location: ?act=order');
            exit;
        }
        
        require_once './views/order/chitietdh.php';
    }

}
?>