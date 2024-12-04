<div class="container mt-5">
        <!-- Title -->
        <h2 class="text-center mb-4">Chi Tiết Đơn Hàng</h2>

        <!-- Order Summary -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Thông Tin Đơn Hàng
            </div>
            <!-- <?php var_dump($_SESSION) ?> -->

            <?php foreach($orders_items as $key => $orders_item): ?>
               <!-- <?php var_dump($orders_item);?> -->
    <?php if ($orders_item['user_id'] == $_SESSION['user_id'] ): // Kiểm tra điều kiện ?>

        <div class="card-body">
            <p><strong>Đơn hàng:</strong><?= $key+1 ?></p>
            <p><strong>Tên sản phẩm:</strong> <?=$orders_item['title']?></p>
            <p><strong>Ngày đặt:</strong> <?=$orders_item['order_date']?></p>
            <?php
// Lấy trạng thái từ cơ sở dữ liệu
$shipping_status = $orders_item['shipping_status'];

// Mảng ánh xạ trạng thái với class CSS và tên tiếng Việt
$status_classes = [
    'pending' => ['class' => 'bg-warning', 'text' => 'Chờ xử lý'],      // Màu vàng
    'delivering' => ['class' => 'bg-info', 'text' => 'Đang giao'],      // Màu xanh dương
    'delivered' => ['class' => 'bg-success', 'text' => 'Đã giao'],      // Màu xanh lá
    'return' => ['class' => 'bg-danger', 'text' => 'Đã hoàn trả'],      // Màu đỏ
    'cancelled' => ['class' => 'bg-dark', 'text' => 'Đã hủy'],          // Màu đen
];

// Lấy class CSS và text tiếng Việt tương ứng (mặc định nếu không khớp)
$status = $status_classes[$shipping_status] ?? ['class' => 'bg-secondary', 'text' => 'Không xác định'];
?>
<p>
    <strong>Trạng thái giao hàng:</strong> 
    <span class="badge <?=$status['class']?>">
        <?=$status['text']?>
    </span>
</p>

            <p><strong>Ngày đặt:</strong> <?=$orders_item['order_date']?></p>
            <p><strong>Số lượng:</strong> <?=$orders_item['quantity']?></p>
            <p><strong>Đơn giá:</strong> <?=$orders_item['unit_price']?></p>
            <p><strong>Tổng tiền:</strong> <?=$orders_item['subtotal']?></p>
            <p><strong>Địa chỉ:</strong> <?=$orders_item['shipping_address']?></p>
            <p><img src="<?=removeFirstChar($orders_item['image'])?>" alt="" style=" width:100px;"></p>
            <p><hr></p>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

        </div>

       
       

        <!-- Action Buttons -->
        <div class="text-center">
            <a href="?act=don-hang" class="btn btn-secondary">Quay lại danh sách đơn hàng</a>
        </div>
    </div>