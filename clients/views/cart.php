<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>
</head>
<body>
    <h2>Danh sách sản phẩm</h2>
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <?php echo htmlspecialchars($product['name']); ?> - 
                <?php echo number_format($product['price']); ?> VND
                <form action="index.php?action=add_to_cart" method="POST" style="display:inline;">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <input type="number" name="quantity" value="1" min="1">
                    <button type="submit">Thêm vào giỏ hàng</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="index.php?action=cart">Xem giỏ hàng</a>
</body>
</html>
