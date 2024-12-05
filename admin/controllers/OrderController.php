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

    
    public function views_edit_order() {
        $order = $this->modelOrder->getById($_GET['id']);
        require_once './views/order/editorder.php';
    }

    public function views_post_edit_order() {
        if (isset($_POST)) {
            $data = [
                ':id' => $_POST['id'],
                ':payment_status' => $_POST['payment_status'],
                ':shipping_status' => $_POST['shipping_status']
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

        if($currentOrder['payment_method'] === 'CREDIT' || $currentOrder['payment_method'] === 'BANKING' || $currentOrder['payment_method'] === 'MOMO'){
            // Kiểm tra và cập nhật trạng thái thanh toán
            if ($currentOrder['payment_status'] === 'unpaid') {
                $data[':payment_status'] = 'processing';
            }
            
            
            $validTransitions = [
                'unpaid' => ['processing', 'cancelled'],  
                'processing' => ['paid', 'failed', 'cancelled'],
                'failed' => ['processing'],
                'paid' => ['refunded'],
                'refunded' => [],
                'cancelled' => []
            ];
           
            // Kiểm tra chuyển đổi trạng thái thanh toán
            if ($data[':payment_status'] !== $currentOrder['payment_status']) {
                if (!isset($validTransitions[$currentOrder['payment_status']])) {
                    throw new Exception("Trạng thái hiện tại không hợp lệ: {$currentOrder['payment_status']}");
                }

                $allowedNextStatuses = $validTransitions[$currentOrder['payment_status']];
                if (!in_array($data[':payment_status'], $allowedNextStatuses)) {
                    throw new Exception("Không thể chuyển từ trạng thái {$currentOrder['payment_status']} sang {$data[':payment_status']}");
                }
            }

            // Kiểm tra điều kiện shipping_status
            if ($data[':shipping_status'] !== $currentOrder['shipping_status']) {
                if ($currentOrder['payment_status'] === 'failed' || $currentOrder['payment_status'] === 'unpaid') {
                    if ($data[':shipping_status'] !== 'cancelled') {
                        throw new Exception("Không thể thay đổi trạng thái đơn hàng khi thanh toán chưa thành công");
                    }
                }
                
                // Chỉ cho phép thay đổi trạng thái đơn hàng khi đã thanh toán thành công
                if ($currentOrder['payment_method'] !== 'COD' && 
                    $currentOrder['payment_status'] !== 'paid' && 
                    $data[':shipping_status'] !== 'cancelled') {
                    throw new Exception("Trạng thái đơn hàng chỉ có thể thay đổi sau khi đã thanh toán thành công");
                }
            }
        }
        
        // Kiểm tra đơn hàng đang giao
        if ($currentOrder['shipping_status'] === 'delivering') {
            if ($data[':shipping_status'] === 'cancelled') {
                throw new Exception("Không thể hủy đơn hàng đang trong quá trình giao");
            }
        }
        

        
        if ($data[':payment_method'] === 'COD') {
            if ($currentOrder['payment_status'] === 'processing') {
                $data[':payment_status'] = 'unpaid';
            }
            // Kiểm tra nếu đơn hàng mới được chuyển sang COD
            if ($currentOrder['payment_method'] !== 'COD') {
                throw new Exception("Không thể chuyển đổi sang phương thức thanh toán COD sau khi đã đặt hàng");
            }
            
            if (!in_array($data[':payment_status'], ['unpaid','paid'])) {
                throw new Exception("COD chỉ có thể có trạng thái chưa thanh toán hoặc thanh toán");
            }

            if ($data[':payment_status'] === 'paid') {
                if ($currentOrder['shipping_status'] !== 'delivered') {
                    throw new Exception("COD chỉ có thể đánh dấu đã thanh toán khi đã giao hàng thành công");
                }
            }
            
           
            
            
        }

        // Kiểm tra trạng thái đơn hàng đã hoàn thành/hủy
        if ($currentOrder['shipping_status'] === 'returned' || 
            $currentOrder['shipping_status'] === 'cancelled') {
            if ($data[':shipping_status'] !== $currentOrder['shipping_status']) {
                throw new Exception("Không thể thay đổi trạng thái của đơn hàng đã hoàn thành/hủy");
            }
        }

        // Kiểm tra đơn hàng đã giao
        if ($currentOrder['shipping_status'] === 'delivered') {
            if ($data[':shipping_status'] !== 'delivered' && 
                $data[':shipping_status'] !== 'returned') {
                throw new Exception("Đơn hàng đã giao thành công chỉ có thể chuyển sang trạng thái trả hàng");
            }
        }

        // Kiểm tra trả hàng
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