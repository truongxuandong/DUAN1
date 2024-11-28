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
                    <a href="./" class="btn btn-primary">Tiếp tục mua sắm</a>
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
                                <th><input type="checkbox" id="select-all" onclick="toggleAll(this)"></th>
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
                                    <td class="text-center" style="width: 150px;">
                                        <?= $item['quantity'] ?>
                                    </td>
                                    <td class="text-right item-total" id="subtotal-<?= $item['id'] ?>">
                                        <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>đ
                                    </td>
                                    <td class="text-center">
                                        <a href="?act=delete-cart-item&id=<?= $item['id'] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" class="item-checkbox" 
                                               data-price="<?= $item['price'] ?>" 
                                               data-quantity="<?= $item['quantity'] ?>"
                                               onchange="updateTotal()">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right"><strong>Tổng tiền:</strong></td>
                                <td class="text-right" id="cart-total">
                                    <strong>0đ</strong>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <a href="./" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Tiếp tục mua sắm
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button onclick="checkoutHandler(event)" class="btn btn-primary" id="checkout-btn" style="opacity: 0.5;" disabled>
                            Thanh toán <i class="fas fa-arrow-right"></i>
                        </button>
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
                url: '?act=update-quantity',
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
                    url: '?act=delete-cart-item',
                    method: 'POST',
                    data: {
                        item_id: itemId
                    },
                    success: function(response) {
                        const result = JSON.parse(response);
                        if (result.success) {
                            // Thêm hiệu ���ng fade out trước khi xóa
                            $('#cart-item-' + itemId).fadeOut(300, function() {
                                $(this).remove();
                                $('#cart-total').html('<strong>' + result.newTotal + 'đ</strong>');

                                // Kiểm tra nếu không còn sản phẩm nào
                                if ($('tbody tr').length === 0) {
                                    $('.table-responsive').fadeOut(300, function() {
                                        $(this).replaceWith(`
                                            <div class="text-center">
                                                <p>Giỏ hàng trống</p>
                                                <a href="./" class="btn btn-primary">Tiếp tục mua sắm</a>
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

        // function updateQuantity(itemId, change) {
        //     const input = document.querySelector(`input[data-item-id="${itemId}"]`);
        //     let newQuantity = parseInt(input.value) + change;

        //     // Đảm bảo số lượng không nhỏ hơn 1
        //     if (newQuantity < 1) {
        //         newQuantity = 1;
        //     }

        //     input.value = newQuantity;
        // }

        // function saveQuantity(itemId) {
        //     const input = document.querySelector(`input[data-item-id="${itemId}"]`);
        //     const newQuantity = parseInt(input.value);

        //     if (newQuantity < 1) {
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Lỗi',
        //             text: 'Số lượng phải lớn hơn 0!'
        //         });
        //         return;
        //     }

        //     // Gửi form cập nhật số lượng
        //     const formData = new FormData();
        //     formData.append('item_id', itemId);
        //     formData.append('quantity', newQuantity);

        //     fetch('?act=update-quantity', {
        //             method: 'POST',
        //             body: formData
        //         })
        //         .then(response => response.text())
        //         .then(() => {
        //             // Hiển thị thông báo thành công
        //             Swal.fire({
        //                 icon: 'success',
        //                 title: 'Thành công',
        //                 text: 'Cập nhật số lượng thành công!',
        //                 showConfirmButton: false,
        //                 timer: 1500
        //             }).then(() => {
        //                 // Reload trang sau khi hiển thị thông báo
        //                 window.location.reload();
        //             });
        //         })
        //         .catch(error => {
        //             console.error('Error:', error);
        //             Swal.fire({
        //                 icon: 'error',
        //                 title: 'Lỗi',
        //                 text: 'Có lỗi xảy ra khi cập nhật số lượng!'
        //             });
        //         });
        // }

        function toggleAll(source) {
            const checkboxes = document.getElementsByClassName('item-checkbox');
            for(let checkbox of checkboxes) {
                checkbox.checked = source.checked;
            }
            updateTotal();
        }

        function checkoutHandler(event) {
            event.preventDefault();
            const checkboxes = document.getElementsByClassName('item-checkbox');
            let hasCheckedItems = false;

            for(let checkbox of checkboxes) {
                if(checkbox.checked) {
                    hasCheckedItems = true;
                    break;
                }
            }

            if(!hasCheckedItems) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Thông báo',
                    text: 'Vui lòng chọn ít nhất một sản phẩm để thanh toán!',
                    confirmButtonColor: '#e53637'
                });
                return false;
            }

            // Nếu có sản phẩm được chọn, chuyển đến trang thanh toán
            window.location.href = '?act=checkout';
        }

        function updateTotal() {
            let total = 0;
            const checkboxes = document.getElementsByClassName('item-checkbox');
            const checkoutBtn = document.getElementById('checkout-btn');
            let hasCheckedItems = false;

            for(let checkbox of checkboxes) {
                if(checkbox.checked) {
                    hasCheckedItems = true;
                    const price = parseFloat(checkbox.getAttribute('data-price'));
                    const quantity = parseInt(checkbox.getAttribute('data-quantity'));
                    total += price * quantity;
                }
            }

            // Cập nhật tổng tiền
            document.getElementById('cart-total').innerHTML = 
                `<strong>${hasCheckedItems ? new Intl.NumberFormat('vi-VN').format(total) : '0'}đ</strong>`;

            // Cập nhật trạng thái nút thanh toán
            checkoutBtn.style.opacity = hasCheckedItems ? '1' : '0.5';
            checkoutBtn.disabled = !hasCheckedItems;
        }
    </script>
    <style>
        .btn-primary {
            background-color: #e53637;
            border-color: #e53637;
            transition: all 0.3s ease;
        }

        .btn-primary:hover:not(:disabled) {
            background-color: #d32f2f;
            border-color: #d32f2f;
        }

        .btn-primary:disabled {
            background-color: #e53637;
            border-color: #e53637;
            cursor: not-allowed;
        }

        #checkout-btn {
            padding: 10px 25px;
            font-weight: 500;
        }

        #checkout-btn i {
            margin-left: 8px;
        }
    </style>
</body>

</html>