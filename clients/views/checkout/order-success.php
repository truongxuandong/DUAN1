<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt hàng thành công</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
                <div class="info-item">
                    <span class="label">Trạng thái thanh toán:</span>
                    <span class="value"><?= htmlspecialchars($order['payment_status']) ?></span>
                </div>
            </div>
        </div>

        <div class="order-summary">
            <div class="summary-header">
                <h3>Chi tiết đơn hàng</h3>
            </div>

            <div class="cart-items">
                <?php 
                $totalAmount = 0;
                
                // Trường hợp mua ngay
                if (isset($_SESSION['buy_now_item'])) {
                    $item = $_SESSION['buy_now_item'];
                    $totalAmount = $item['price'] * $item['quantity'];
                ?>
                    <div class="cart-item">
                        <img src="<?= removeFirstChar($item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>">
                        <div class="item-info">
                            <h4><?= htmlspecialchars($item['title']) ?></h4>
                            <div class="item-details">
                                <span>Số lượng: <?= $item['quantity'] ?></span>
                                <span class="price"><?= number_format($item['unit_price'], 0, ',', '.') ?>đ</span>
                            </div>
                        </div>
                    </div>
                <?php
                } 
                // Trường hợp đặt hàng từ giỏ hàng
                else {
                    foreach ($orderItems as $item): 
                        $totalAmount += $item['unit_price'] * $item['quantity'];
                ?>
                    <div class="cart-item">
                        <img src="<?= removeFirstChar($item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>">
                        <div class="item-info">
                            <h4><?= htmlspecialchars($item['title']) ?></h4>
                            <div class="item-details">
                                <span>Số lượng: <?= $item['quantity'] ?></span>
                                <span class="price"><?= number_format($item['unit_price'], 0, ',', '.') ?>đ</span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;
                }
                ?>
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
            <a href="?act=don-hang" class="btn btn-outline">Xem đơn hàng</a>
        </div>
    </div>

    <style>
        .order-success-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }

        .success-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .success-header i {
            color: #28a745;
            font-size: 48px;
            margin-bottom: 15px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .info-item {
            padding: 10px;
            background: #f8f9fa;
            border-radius: 4px;
        }

        .info-item .label {
            font-weight: bold;
            color: #666;
        }

        .cart-item {
            display: flex;
            padding: 15px;
            border-bottom: 1px solid #eee;
            align-items: center;
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

        .item-details {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .price {
            color: #e53637;
            font-weight: bold;
        }

        .summary-footer {
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 4px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .summary-row.total {
            font-size: 18px;
            font-weight: bold;
            color: #e53637;
            border-top: 1px solid #ddd;
            padding-top: 10px;
            margin-top: 10px;
        }

        .action-buttons {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
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

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
            transition: all 0.2s;
        }
    </style>
</body>
</html>