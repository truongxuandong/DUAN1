<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt hàng thành công</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <span class="value"><?= date('d/m/Y H:i', strtotime($order['order_date'])) ?></span>
                </div>
                <div class="info-item">
                    <span class="label">Người nhận:</span>
                    <span class="value"><?= htmlspecialchars($order['receiver_name']) ?></span>
                </div>
                <div class="info-item">
                    <span class="label">Số điện thoại:</span>
                    <span class="value"><?= htmlspecialchars($order['phone_car']) ?></span>
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

        <div class="order-summary">
            <div class="summary-header">
                <h3>Chi Tiết đơn hàng</h3>
            </div>

            <div class="cart-items">
                <?php foreach ($orderItems as $item): ?>
                <div class="cart-item">
                    <img src="<?= $item['image'] ?>" alt="<?= $item['title'] ?>">
                    <div class="item-info">
                        <h4><?= $item['title'] ?></h4>
                        <div class="item-details">
                            <span>Số lượng: <?= $item['quantity'] ?></span>
                            <span class="price"><?= number_format($item['unit_price'], 0, ',', '.') ?>đ</span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="summary-footer">
                <div class="summary-row">
                    <span>Tạm tính:</span>
                    <span><?= number_format($order['total_amount'], 0, ',', '.') ?>đ</span>
                </div>
                <div class="summary-row">
                    <span>Phí vận chuyển:</span>
                    <span>0đ</span>
                </div>
                <div class="summary-row total">
                    <span>Tổng cộng:</span>
                    <span><?= number_format($order['total_amount'], 0, ',', '.') ?>đ</span>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <a href="index.php" class="btn btn-primary">Tiếp tục mua sắm</a>
            <a href="?act=profile" class="btn btn-outline">Xem đơn hàng</a>
        </div>
    </div>

    <style>
        .order-summary {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-top: 20px;
        }

        .summary-header {
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .cart-items {
            margin-bottom: 20px;
        }

        .cart-item {
            display: flex;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .cart-item img {
            width: 80px;
            height: 120px;
            object-fit: cover;
            margin-right: 15px;
        }

        .item-info {
            flex: 1;
        }

        .item-info h4 {
            margin: 0 0 10px 0;
            font-size: 16px;
        }

        .item-details {
            display: flex;
            justify-content: space-between;
            color: #666;
            font-size: 14px;
        }

        .price {
            color: #e53637;
            font-weight: bold;
        }

        .summary-footer {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .summary-row.total {
            font-size: 18px;
            font-weight: bold;
            color: #e53637;
            border-top: 1px solid #eee;
            padding-top: 10px;
            margin-top: 10px;
        }

        .action-buttons {
            margin-top: 20px;
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn-primary {
            background: #e53637;
            color: white;
            border: none;
        }

        .btn-outline {
            border: 1px solid #e53637;
            color: #e53637;
            background: white;
        }
    </style>
</body>
</html>