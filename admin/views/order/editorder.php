<div class="content-wrapper">
    <section class="content-header">
        <h1>Cập nhật đơn hàng</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin đơn hàng</h3>
                    </div>
                    <form method="post" action="?act=post-edit-order">
                        <!-- Sử dụng hidden field để lưu id đơn hàng -->
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($order['id']) ; ?>">

                        <div class="box-body">
                            <!-- Thông tin User ID -->
                            <div class="form-group">
                                <label>tên khách hàng</label>
                                <input type="text" class="form-control" name="user_id" 
                                       value="<?php echo htmlspecialchars($order['receiver_name'] ?? ''); ?>" readonly>
                            </div>
                            
                            
                            <div class="form-group">
                                <label>phone</label>
                                <input type="text" class="form-control" name="phone_car" 
                                       value="<?php echo htmlspecialchars($order['phone_car']); ?>" readonly>
                            </div>

                            <!-- Tổng tiền (total_amount) -->
                            <div class="form-group">
                                <label>Tổng tiền</label>
                                <input type="number" class="form-control" name="total_amount" 
                                       value="<?php echo htmlspecialchars($order['total_amount']); ?>" readonly>
                            </div>
                            <!-- Phương thức thanh toán (payment_method) -->
                            <div class="form-group">
                                <label>Phương thức thanh toán</label>
                                <input type="text" class="form-control" name="payment_method" value="<?php echo htmlspecialchars($order['payment_method']); ?>" readonly>

                            </div>
                            <!-- Trạng thái thanh toán (payment_status) -->
                            <div class="form-group">
                                <label>Trạng thái thanh toán</label>
                                <select class="form-control" name="payment_status">
                                    <option value="unpaid" <?php echo $order['payment_status'] == 'unpaid' ? 'selected' : ''; ?>>Chưa thanh toán</option>
                                    <option value="paid" <?php echo $order['payment_status'] == 'paid' ? 'selected' : ''; ?>>Đã thanh toán</option>
                                    <option value="refunded" <?php echo $order['payment_status'] == 'refunded' ? 'selected' : ''; ?>>Hoàn tiền</option>
                                    <option value="failed" <?php echo $order['payment_status'] == 'failed' ? 'selected' : ''; ?>>Thất bại</option>
                                    <option value="processing" <?php echo $order['payment_status'] == 'processing' ? 'selected' : ''; ?>>Đang xử lý</option>
                                </select>
                            </div>

                            <!-- Trạng thái vận chuyển (shipping_status) -->
                            <div class="form-group">
                                <label>Trạng thái vận chuyển</label>
                                <select class="form-control" name="shipping_status">
                                    <option value="pending" <?php echo $order['shipping_status'] == 'pending' ? 'selected' : ''; ?>>Đang xử lý</option>
                                    <option value="delivering" <?php echo $order['shipping_status'] == 'delivering' ? 'selected' : ''; ?>>Đang giao hàng</option>
                                    <option value="delivered" <?php echo $order['shipping_status'] == 'delivered' ? 'selected' : ''; ?>>Đã giao hàng</option>
                                    <option value="returned" <?php echo $order['shipping_status'] == 'returned' ? 'selected' : ''; ?>>Đã trả hàng</option>
                                    <option value="cancelled" <?php echo $order['shipping_status'] == 'cancelled' ? 'selected' : ''; ?>>Đã hủy</option>
                                </select>
                            </div>

                           
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
