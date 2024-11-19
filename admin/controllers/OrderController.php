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
        // Get current order status
        $currentOrder = $this->modelOrder->getById($_GET['id']);
        
        // Check if order can be deleted based on shipping status
        if ($currentOrder['shipping_status'] === 'delivered' || 
            $currentOrder['shipping_status'] === 'returned' || 
            $currentOrder['shipping_status'] === 'cancelled') {
            
            if ($this->modelOrder->deleteorder($_GET['id'])) {
                $_SESSION['success'] = "Xóa đơn hàng thành công";
            } else {
                $_SESSION['error'] = "Xóa đơn hàng thất bại";
            }
        } else {
            $_SESSION['error'] = "Chỉ có thể xóa đơn hàng đã giao thành công, đã trả hàng hoặc đã hủy";
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
                ':payment_method' => $_POST['payment_method']
                
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

        if ($data[':payment_method'] !== $currentOrder['payment_method']) {
            if ($currentOrder['shipping_status'] !== 'returned') {
                throw new Exception("Không thể thay đổi phương thức thanh toán sau khi đã đặt hàng");
            }
        }

        if($currentOrder['payment_method'] === 'Credit Card' || $currentOrder['payment_method'] === 'Internet Banking' || $currentOrder['payment_method'] === 'E-Wallet'){
            // Kiểm tra và cập nhật trạng thái thanh toán
            if ($currentOrder['payment_status'] === 'unpaid') {
                $data[':payment_status'] = 'processing';
            }
            
            // Định nghĩa luồng chuyển đổi trạng thái hợp lệ
            $validTransitions = [
                'unpaid' => ['processing', 'cancelled'],  
                'processing' => ['paid', 'failed', 'cancelled'],
                'failed' => ['processing'],
                'paid' => ['refunded'],
                'refunded' => [],
                'cancelled' => []
            ];
           
            // Nếu đang cập nhật trạng thái thanh toán
            if ($data[':payment_status'] !== $currentOrder['payment_status']) {
                // Nếu trạng thái hiện tại không tồn tại trong validTransitions
                if (!isset($validTransitions[$currentOrder['payment_status']])) {
                    throw new Exception("Trạng thái hiện tại không hợp lệ: {$currentOrder['payment_status']}");
                }

                $allowedNextStatuses = $validTransitions[$currentOrder['payment_status']];
                if (!in_array($data[':payment_status'], $allowedNextStatuses)) {
                    throw new Exception("Không thể chuyển từ trạng thái {$currentOrder['payment_status']} sang {$data[':payment_status']}");
                }

               
            }
             // Kiểm tra trạng thái thanh toán và đơn hàng
            if ($data[':shipping_status'] !== $currentOrder['shipping_status']) {
                

                // Chỉ cho phép thay đổi sang trạng thái "cancelled" khi thanh toán thất bại
                if ($currentOrder['payment_status'] === 'failed' || $currentOrder['payment_status'] === 'unpaid') {
                    if ($data[':shipping_status'] !== 'cancelled') {
                        throw new Exception("Không thể thay đổi trạng thái đơn hàng khi thanh toán chưa thành công");
                    }
                }
                
                // Chỉ cho phép thay đổi trạng thái đơn hàng khi đã thanh toán thành công
                if ($currentOrder['payment_method'] !== 'Cash on Delivery' && 
                    $currentOrder['payment_status'] !== 'paid' && 
                    $data[':shipping_status'] !== 'cancelled') {
                    throw new Exception("Trạng thái đơn hàng chỉ có thể thay đổi sau khi đã thanh toán thành công");
                }
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
            // Kiểm tra nếu đơn hàng mới được chuyển sang COD
            if ($currentOrder['payment_method'] !== 'Cash on Delivery') {
                throw new Exception("Không thể chuyển đổi sang phương thức thanh toán COD sau khi đã đặt hàng");
            }
            
            // Chỉ cho phép 2 trạng thái thanh toán với COD: unpaid và paid
            if (!in_array($data[':payment_status'], ['unpaid','paid'])) {
                throw new Exception("COD chỉ có thể có trạng thái chưa thanh toán hoặc thanh toán");
            }

            // Chỉ cho phép đánh dấu đã thanh toán khi đã giao hàng thành công
            if ($data[':payment_status'] === 'paid' ) {
                if ($data[':shipping_status'] !== 'returned') {
                    throw new Exception("không thể thay đổi trạng thái đơn hàng khi thành công trừ trả hàng");
                }
            }
            if ($data[':payment_status'] === 'paid') {
                if ($currentOrder['shipping_status'] !== 'delivered') {
                    throw new Exception("COD chỉ có thể đánh dấu đã thanh toán khi đã giao hàng thành công");
                }
            }
           
            
            
        }

        if ($currentOrder['shipping_status'] === 'returned' || $currentOrder['shipping_status'] === 'cancelled') {
            if ($data[':shipping_status'] !== $currentOrder['shipping_status']) {
                throw new Exception("Không thể thay đổi trạng thái của đơn hàng ");
            }
        }
        
        

         
        if ($data[':shipping_status'] === 'cancelled' && 
            $currentOrder['shipping_status'] === 'delivered') {
            throw new Exception("Không thể hủy đơn hàng đã giao thành công");
        }

        if ($currentOrder['shipping_status'] === 'delivered') {
            if ($data[':shipping_status'] !== 'delivered' && $data[':shipping_status'] !== 'returned') {
                throw new Exception("Đơn hàng đã giao thành công chỉ có thể chuyển sang trạng thái trả hàng");
            }
        }
        if ($data[':shipping_status'] === 'returned') {
            if ($currentOrder['shipping_status'] !== 'delivered') {
                throw new Exception("Không thể trả hàng khi đơn hàng chưa giao thành công");
            }
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