<div class="container-fluid" style="margin-top: -24px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6" style="padding:10px 5px;">
                    <h2>Quản lí đơn hàng</h2>
                </div>
            </div>
        </div>
    </section>

    <div class="container my-5">
    <h2 class="mb-4">Chi Tiết Đơn Hàng</h2>

    <!-- Thông tin khách hàng -->
    <div class="mb-4">
    <h4>Thông tin khách hàng</h4>
    <div class="form-group">
        <label for="">Tên khách hàng:</label>
        <p ><?php echo $order['receiver_name']; ?></p>
    </div>
    <div class="form-group">
        <label for="">Email:</label>
        <p ><?php echo $order['email']; ?></p>
    </div>
    <div class="form-group">
        <label for="">Số điện thoại:</label>
        <p ><?php echo $order['phone_car']; ?></p>
    </div>
    <div class="form-group">
        <label for="">Địa chỉ giao hàng:</label>
        <p ><?php echo $order['shipping_address']; ?></p>
    </div>
    <div class="form-group">
        <label for="">Phương thức thanh toán:</label>
        <p ><?php echo $order['payment_method']; ?></p>
    </div>


    <!-- Chi tiết sản phẩm -->
    <div class="mb-4">
        <h4>Chi tiết sản phẩm</h4>
        <div class="table-responsive">
        <table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Ngày đặt hàng</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>
    </thead> 
    <tbody>
        <?php 
        $total_amount = 0; 
        foreach ($detailsp as $index => $itemsp): 
            $item_total = $itemsp['unit_price'] * $itemsp['quantity']; 
            $total_amount += $item_total; 
            
        ?>
        <tr>
            
            <td><?php echo $index + 1; ?></td> 
            <td><?php echo $itemsp['title'] ?? $itemsp['order_id']; ?></td>
            <td><?php echo $itemsp['order_date']; ?></td>
            <td><?php echo $itemsp['quantity']; ?></td>
            <td><?php echo number_format($itemsp['unit_price'], 0, ',', '.'); ?>₫</td>
            <td><?php echo number_format($item_total, 0, ',', '.'); ?>₫</td> 
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" style="text-align: right;"><strong>Tổng cộng:</strong></td>
            <td><strong><?php echo number_format($total_amount, 0, ',', '.'); ?>₫</strong></td> 
    </tfoot>
</table>
 <!-- Nút in hóa đơn khi đã giao hàng thành công -->


     <button onclick="printOrder(<?= $order['id'] ?>)" class="btn btn-success btn-sm">
         <i class="fas fa fa-print"></i> In Hoá Đơn
     </button>
      
     <a href="?act=order" class="btn btn-success btn-sm">Quay lại</a>

 

<!-- Thêm script in hóa đơn -->
<script>
function printOrder(orderId) {
    
    // Mở trang chi tiết đơn hàng trong cửa sổ in
    let printWindow = window.open(`?act=order-detail&id=${orderId}&print=true`, '_blank');
    
    // Kiểm tra xem cửa sổ đã được mở hay chưa
    if (printWindow) {
        // Sử dụng onload để in khi trang đã tải xong
        printWindow.addEventListener('load', function() {
            printWindow.print();
        }, true);
    } else {
        alert("Cửa sổ in bị chặn. Hãy kiểm tra cài đặt trình duyệt.");
    }
}
</script>

</script>
