<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt hàng thành công</title>
    <link rel="stylesheet" href="./clients/assets/css/order-success.css">
</head>
<body>
    <div class="order-success-container">
        <div class="success-header">
            <i class="fas fa-check-circle"></i>
            <h2>Đặt hàng thành công!</h2>
            <p>Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn đang được xử lý.</p>
        </div>

        <div class="order-info">
            <h3>Thông tin đơn hàng #<?= $order['id'] ?></h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="label">Ngày đặt:</span>
                    <span class="value"><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></span>
                </div>
                <div class="info-item">
                    <span class="label">Người nhận:</span>
                    <span class="value"><?= htmlspecialchars($order['fullname']) ?></span>
                </div>
                <div class="info-item">
                    <span class="label">Số điện thoại:</span>
                    <span class="value"><?= htmlspecialchars($order['phone']) ?></span>
                </div>
                <div class="info-item">
                    <span class="label">Địa chỉ:</span>
                    <span class="value"><?= htmlspecialchars($order['shipping_address']) ?></span>
                </div>
                <div class="info-item">
                    <span class="label">Phương thức thanh toán:</span>
                    <span class="value"><?= htmlspecialchars($order['payment_method']) ?></span>
                </div>
            </div>
        </div>

        <div class="order-items">
            <h3>Chi tiết đơn hàng</h3>
            <?php foreach ($orderItems as $item): ?>
            <div class="order-item">
                <img src="<?= $item['image'] ?>" alt="<?= $item['title'] ?>">
                <div class="item-info">
                    <h4><?= htmlspecialchars($item['title']) ?></h4>
                    <div class="item-details">
                        <span>Số lượng: <?= $item['quantity'] ?></span>
                        <span class="price"><?= number_format($item['unit_price'], 0, ',', '.') ?>đ</span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <div class="order-total">
                <span>Tổng cộng:</span>
                <span class="total-amount"><?= number_format($order['total_amount'], 0, ',', '.') ?>đ</span>
            </div>
        </div>

        <div class="action-buttons">
            <a href="index.php" class="btn btn-primary">Tiếp tục mua sắm</a>
            <a href="?act=profile" class="btn btn-outline">Xem đơn hàng</a>
        </div>
    </div>
</body>
</html>