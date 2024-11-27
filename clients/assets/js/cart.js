// Lưu trữ giá trị ban đầu của số lượng
const originalQuantities = {};

// Khởi tạo giá trị ban đầu
document.querySelectorAll('.quantity-input').forEach(input => {
    const itemId = input.dataset.itemId;
    originalQuantities[itemId] = input.value;
});

function quantityChanged(itemId) {
    const input = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
    if (input.value < 1) input.value = 1;
    
    const updateBtn = document.querySelector(`.btn-update-quantity[data-item-id="${itemId}"]`);
    updateBtn.style.display = input.value !== originalQuantities[itemId] ? 'block' : 'none';
}

function increaseQuantity(itemId) {
    const input = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
    input.value = parseInt(input.value) + 1;
    quantityChanged(itemId);
}

function decreaseQuantity(itemId) {
    const input = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
    if (input.value > 1) {
        input.value = parseInt(input.value) - 1;
        quantityChanged(itemId);
    }
}

function updateCartItem(itemId) {
    const input = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
    const updateBtn = document.querySelector(`.btn-update-quantity[data-item-id="${itemId}"]`);
    const quantity = input.value;

    updateBtn.disabled = true;
    updateBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang cập nhật';

    $.ajax({
        url: 'index.php?act=update-quantity',
        method: 'POST',
        data: { item_id: itemId, quantity: quantity },
        success: function(response) {
            const result = JSON.parse(response);
            if (result.success) {
                originalQuantities[itemId] = quantity;
                $('#cart-total').html(`<strong>${result.newTotal}đ</strong>`);
                $(`#subtotal-${itemId}`).text(`${result.itemSubtotal}đ`);
                updateBtn.style.display = 'none';

                Swal.fire({
                    icon: 'success',
                    title: 'Cập nhật thành công!',
                    text: 'Số lượng đã được thay đổi.',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Cập nhật thất bại!',
                    text: result.message || 'Đã xảy ra lỗi.',
                });
                input.value = originalQuantities[itemId];
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi mạng!',
                text: 'Không thể kết nối đến máy chủ.',
            });
            input.value = originalQuantities[itemId];
        },
        complete: function() {
            setTimeout(() => {
                updateBtn.disabled = false;
                updateBtn.innerHTML = '<i class="fas fa-sync"></i> Cập nhật';
            }, 1000);
        }
    });
}

function removeItem(itemId) {
    Swal.fire({
        title: 'Xác nhận xóa',
        text: 'Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Có, xóa ngay!',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `index.php?act=delete-cart-item&id=${itemId}`;
        }
    });
} 