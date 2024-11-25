<!-- listCart.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
</head>
<body>
    <h1>Giỏ hàng của bạn</h1>

    <?php if (isset($cartItems) && count($cartItems) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Tổng</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $totalAmount = 0;
                foreach ($cartItems as $index => $item): 
                    $total = $item['quantity'] * $item['unit_price'];
                    $totalAmount += $total;
                ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($item['comic_name']) ?></td>
                        <td><?= htmlspecialchars($item['category_name']) ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= number_format($item['unit_price'], 2) ?> VND</td>
                        <td><?= number_format($total, 2) ?> VND</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h3>Tổng cộng: <?= number_format($totalAmount, 2) ?> VND</h3>
    <?php else: ?>
        <p>Giỏ hàng của bạn hiện tại trống.</p>
    <?php endif; ?>

    <a href="checkout.php">Tiến hành thanh toán</a>
</body>
</html>
