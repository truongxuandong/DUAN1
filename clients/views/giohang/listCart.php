<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="./clients/assets/css/listCart.css" stylesheet="">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['message'];
            unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error'];
            unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <main class="main">
        <div class="container mt-4">
            <h2 class="text-center mb-4">Giỏ hàng của bạn</h2>

            <?php if (empty($cartItems)): ?>
                <div class="text-center">
                    <p>Giỏ hàng trống</p>
                    <a href="index.php" class="btn btn-primary">Tiếp tục mua sắm</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>Ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cartItems as $item): ?>
                                <tr id="cart-item-<?= $item['id'] ?>">
                                    <td class="text-center" style="width: 100px;">
                                        <img src="<?= $item['image'] ?>" alt="<?= $item['title'] ?>" class="img-fluid" style="max-width: 80px;">
                                    </td>
                                    <td><?= $item['title'] ?></td>
                                    <td class="text-right">
                                        <?= number_format($item['price'], 0, ',', '.') ?>đ
                                    </td>
                                    <!-- Thay đổi phần td chứa số lượng -->
                                    <td class="text-center" style="width: 150px;">
                                        <div class="quantity-control">
                                            <div class="input-group">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    onclick="updateQuantity(<?= $item['id'] ?>, -1)"
                                                    style="width: 40px; font-weight: bold;">
                                                    -
                                                </button>

                                                <input type="number" class="form-control text-center quantity-input"
                                                    value="<?= $item['quantity'] ?>"
                                                    min="1"
                                                    data-item-id="<?= $item['id'] ?>"
                                                    style="max-width: 60px;">

                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    onclick="updateQuantity(<?= $item['id'] ?>, 1)"
                                                    style="width: 40px; font-weight: bold;">
                                                    +
                                                </button>
                                            </div>
                                            <button type="button" class="btn btn-success btn-sm mt-2"
                                                onclick="saveQuantity(<?= $item['id'] ?>)"
                                                style="width: 140px; font-weight: 500;">
                                                Cập nhật
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-right item-total" id="subtotal-<?= $item['id'] ?>">
                                        <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>đ
                                    </td>
                                    <td class="text-center">
                                        <a href="index.php?act=delete-cart-item&id=<?= $item['id'] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right"><strong>Tổng tiền:</strong></td>
                                <td class="text-right" id="cart-total">
                                    <strong><?= number_format($totalAmount, 0, ',', '.') ?>đ</strong>
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <a href="index.php" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Tiếp tục mua sắm
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="index.php?act=checkout" class="btn btn-primary">
                            Thanh toán <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>
    <script>
        function updateCartItem(itemId) {
            const input = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
            const quantity = input.value;

            // Gửi yêu cầu AJAX
            $.ajax({
                url: 'index.php?act=update-quantity',
                method: 'POST',
                data: {
                    item_id: itemId,
                    quantity: quantity
                },
                success: function(response) {
                    const result = JSON.parse(response);
                    if (result.success) {
                        // Cập nhật thành tiền và tổng tiền
                        $(`#subtotal-${itemId}`).text(`${result.itemSubtotal}đ`);
                        $('#cart-total').html(`<strong>${result.newTotal}đ</strong>`);

                        // Hiển thị thông báo thành công
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công',
                            text: result.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: result.message || 'Đã xảy ra lỗi khi cập nhật',
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi kết nối',
                        text: 'Không thể kết nối đến máy chủ!',
                    });
                }
            });
        }

        function removeItem(itemId) {
            if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
                $.ajax({
                    url: 'index.php?act=delete-cart-item',
                    method: 'POST',
                    data: {
                        item_id: itemId
                    },
                    success: function(response) {
                        const result = JSON.parse(response);
                        if (result.success) {
                            // Thêm hiệu ứng fade out trước khi xóa
                            $('#cart-item-' + itemId).fadeOut(300, function() {
                                $(this).remove();
                                $('#cart-total').html('<strong>' + result.newTotal + 'đ</strong>');

                                // Kiểm tra nếu không còn sản phẩm nào
                                if ($('tbody tr').length === 0) {
                                    $('.table-responsive').fadeOut(300, function() {
                                        $(this).replaceWith(`
                                            <div class="text-center">
                                                <p>Giỏ hàng trống</p>
                                                <a href="index.php" class="btn btn-primary">Tiếp tục mua sắm</a>
                                            </div>
                                        `);
                                    });
                                }
                            });

                            // Hiển thị thông báo thành công
                            alert('Đã xóa sản phẩm khỏi giỏ hàng!');
                        } else {
                            alert('Không thể xóa sản phẩm. Vui lòng thử lại!');
                        }
                    },
                    error: function() {
                        alert('Đã xảy ra lỗi khi xóa sản phẩm!');
                    }
                });
            }
        }

        function updateQuantity(itemId, change) {
            const input = document.querySelector(`input[data-item-id="${itemId}"]`);
            let newQuantity = parseInt(input.value) + change;

            // Đảm bảo số lượng không nhỏ hơn 1
            if (newQuantity < 1) {
                newQuantity = 1;
            }

            input.value = newQuantity;
        }

        function saveQuantity(itemId) {
            const input = document.querySelector(`input[data-item-id="${itemId}"]`);
            const newQuantity = parseInt(input.value);

            if (newQuantity < 1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Số lượng phải lớn hơn 0!'
                });
                return;
            }

            // Gửi form cập nhật số lượng
            const formData = new FormData();
            formData.append('item_id', itemId);
            formData.append('quantity', newQuantity);

            fetch('index.php?act=update-quantity', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(() => {
                    // Hiển thị thông báo thành công
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công',
                        text: 'Cập nhật số lượng thành công!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        // Reload trang sau khi hiển thị thông báo
                        window.location.reload();
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: 'Có lỗi xảy ra khi cập nhật số lượng!'
                    });
                });
        }
    </script>
</body>

</html>