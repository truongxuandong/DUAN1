<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./clients/assets/css/thanhtoan.css">
</head>
<body>
    <div class="checkout-container">
        <div class="checkout-header">
            <h2>Thanh toán đơn hàng</h2>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <div class="checkout-content">
            <!-- Form thanh toán -->
            <div class="checkout-form">
                <div class="form-header">
                    <h3>Thông tin thanh toán</h3>
                </div>
                
                <form action="?act=process-checkout" method="POST" id="checkout-form">
                    <div class="form-group">
                        <label>Họ tên người nhận:</label>
                        <input type="text" name="receiver_name" required 
                               value="<?= $_SESSION['user']['fullname'] ?? '' ?>">
                    </div>

                    <div class="form-group">
                        <label>Số điện thoại:</label>
                        <input type="tel" name="phone_car" required 
                               value="<?= $_SESSION['user']['phone'] ?? '' ?>">
                    </div>

                    <div class="form-group">
                        <label>Địa chỉ giao hàng:</label>
                        <textarea name="shipping_address" required><?= $_SESSION['user']['address'] ?? '' ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Phương thức thanh toán:</label>
                        <select name="payment_method" required id="payment-method">
                            <option value="">Chọn phương thức thanh toán</option>
                            <option value="COD">Thanh toán khi nhận hàng</option>
                            <option value="CREDIT">Thẻ tín dụng</option>
                            <option value="BANKING">Chuyển khoản ngân hàng</option>
                            <option value="MOMO">Ví MoMo</option>
                        </select>
                    </div>

                    <!-- Form thẻ tín dụng -->
                    <div class="credit-card-form" id="credit-card-form">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="mb-2">Số thẻ</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-credit-card"></i>
                                        </span>
                                        <input type="text" class="form-control" id="card-number" 
                                               placeholder="1234 5678 9012 3456" 
                                               maxlength="19">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-7">
                                <div class="form-group mb-3">
                                    <label class="mb-2">Ngày hết hạn</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="expiry-date" 
                                               placeholder="MM/YY" maxlength="5">
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group mb-3">
                                    <label class="mb-2">CVV</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="cvv" 
                                               placeholder="***" maxlength="3">
                                        <span class="input-group-text">
                                            <i class="fas fa-question-circle" 
                                               data-bs-toggle="tooltip" 
                                               title="3 số ở mặt sau thẻ"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="mb-2">Tên chủ thẻ</label>
                                    <input type="text" class="form-control" id="card-holder" 
                                           placeholder="NGUYEN VAN A">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Internet Banking -->
                    <div class="banking-form" id="banking-form" style="display: none;">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="mb-2">Chọn ngân hàng</label>
                                <select class="form-select" id="bank-select">
                                    <option value="">Chọn ngân hàng</option>
                                    <option value="MB">MB Bank</option>
                                    <option value="VCB">Vietcombank</option>
                                    <option value="TCB">Techcombank</option>
                                    <option value="VTB">Vietinbank</option>
                                    <option value="BIDV">BIDV</option>
                                    <option value="ACB">ACB</option>
                                </select>
                            </div>
                            
                            <!-- Thông tin tài khoản MB Bank -->
                            <div class="bank-details" id="MB-details" style="display: none;">
                                <div class="col-12">
                                    <div class="bank-info mb-3 p-3 border rounded">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="./clients/assets/img/mb-bank-logo.png" alt="MB Bank" height="40" class="me-2">
                                            <h5 class="mb-0">MB Bank</h5>
                                        </div>
                                        <div class="account-details">
                                            <p class="mb-2"><strong>Số tài khoản:</strong> 0865819798</p>
                                            <p class="mb-2"><strong>Chủ tài khoản:</strong> TRUONG XUAN DONG</p>
                                            <p class="mb-2"><strong>Chi nhánh:</strong> MB Hà Nội</p>
                                            <p class="mb-2"><strong>Nội dung:</strong> <span id="mb-content">DH<?= time() ?></span></p>
                                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="copyToClipboard('mb-content')">
                                                <i class="fas fa-copy"></i> Sao chép
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Thông tin tài khoản Vietcombank -->
                            <div class="bank-details" id="VCB-details" style="display: none;">
                                <div class="col-12">
                                    <div class="bank-info mb-3 p-3 border rounded">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="./clients/assets/img/vcb-logo.png" alt="Vietcombank" height="40" class="me-2">
                                            <h5 class="mb-0">Vietcombank</h5>
                                        </div>
                                        <div class="account-details">
                                            <p class="mb-2"><strong>Số tài khoản:</strong> 1234567890</p>
                                            <p class="mb-2"><strong>Chủ tài khoản:</strong> TRUONG XUAN DONG</p>
                                            <p class="mb-2"><strong>Chi nhánh:</strong> VCB Hà Nội</p>
                                            <p class="mb-2"><strong>Nội dung:</strong> <span id="vcb-content">DH<?= time() ?></span></p>
                                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="copyToClipboard('vcb-content')">
                                                <i class="fas fa-copy"></i> Sao chép
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Thông tin tài khoản Techcombank -->
                            <div class="bank-details" id="TCB-details" style="display: none;">
                                <div class="col-12">
                                    <div class="bank-info mb-3 p-3 border rounded">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="./clients/assets/img/tcb-logo.png" alt="MB Bank" height="40" class="me-2">
                                            <h5 class="mb-0">Techcombank</h5>
                                        </div>
                                        <div class="account-details">
                                            <p class="mb-2"><strong>Số tài khoản:</strong> 0865819798</p>
                                            <p class="mb-2"><strong>Chủ tài khoản:</strong> TRUONG XUAN DONG</p>
                                            <p class="mb-2"><strong>Chi nhánh:</strong> TCB Hà Nội</p>
                                            <p class="mb-2"><strong>Nội dung:</strong> <span id="tcb-content">DH<?= time() ?></span></p>
                                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="copyToClipboard('tcb-content')">
                                                <i class="fas fa-copy"></i> Sao chép
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Thông tin tài khoản Vietinbank -->
                            <div class="bank-details" id="VTB-details" style="display: none;">
                                <div class="col-12">
                                    <div class="bank-info mb-3 p-3 border rounded">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="./clients/assets/img/vtb-logo.png" alt="Vietinbank" height="40" class="me-2">
                                            <h5 class="mb-0">Vietinbank</h5>
                                        </div>
                                        <div class="account-details">
                                            <p class="mb-2"><strong>Số tài khoản:</strong> 0865819798</p>
                                            <p class="mb-2"><strong>Chủ tài khoản:</strong> TRUONG XUAN DONG</p>
                                            <p class="mb-2"><strong>Chi nhánh:</strong> VTB Hà Nội</p>
                                            <p class="mb-2"><strong>Nội dung:</strong> <span id="vtb-content">DH<?= time() ?></span></p>
                                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="copyToClipboard('vtb-content')">
                                                <i class="fas fa-copy"></i> Sao chép
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Thông tin tài khoản BIDV -->
                            <div class="bank-details" id="BIDV-details" style="display: none;">
                                <div class="col-12">
                                    <div class="bank-info mb-3 p-3 border rounded">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="./clients/assets/img/bidv-logo.png" alt="BIDV" height="40" class="me-2">
                                            <h5 class="mb-0">BIDV</h5>
                                        </div>
                                        <div class="account-details">
                                            <p class="mb-2"><strong>Số tài khoản:</strong> 0865819798</p>
                                            <p class="mb-2"><strong>Chủ tài khoản:</strong> TRUONG XUAN DONG</p>
                                            <p class="mb-2"><strong>Chi nhánh:</strong> BIDV Hà Nội</p>
                                            <p class="mb-2"><strong>Nội dung:</strong> <span id="bidv-content">DH<?= time() ?></span></p>
                                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="copyToClipboard('bidv-content')">
                                                <i class="fas fa-copy"></i> Sao chép
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Thông tin tài khoản ACB -->
                            <div class="bank-details" id="ACB-details" style="display: none;">
                                <div class="col-12">
                                    <div class="bank-info mb-3 p-3 border rounded">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="./clients/assets/img/acb-logo.png" alt="ACB" height="40" class="me-2">
                                            <h5 class="mb-0">ACB</h5>
                                        </div>
                                        <div class="account-details">
                                            <p class="mb-2"><strong>Số tài khoản:</strong> 0865819798</p>
                                            <p class="mb-2"><strong>Chủ tài khoản:</strong> TRUONG XUAN DONG</p>
                                            <p class="mb-2"><strong>Chi nhánh:</strong> ACB Hà Nội</p>
                                            <p class="mb-2"><strong>Nội dung:</strong> <span id="acb-content">DH<?= time() ?></span></p>
                                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="copyToClipboard('acb-content')">
                                                <i class="fas fa-copy"></i> Sao chép
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Ví MoMo -->
                    <div class="momo-form" id="momo-form" style="display: none;">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center mb-3">
                                    <img src="./clients/assets/img/momo-logo.png" alt="MoMo" style="height: 50px;">
                                </div>
                                <div class="momo-info p-3 border rounded">
                                    <div class="text-center mb-3">
                                        <img src="./clients/assets/img/momo-qr.png" alt="MoMo QR" style="max-width: 200px;">
                                    </div>
                                    <div class="account-details">
                                        <p class="mb-2"><strong>Số điện thoại:</strong> 0865819798</p>
                                        <p class="mb-2"><strong>Chủ tài khoản:</strong> TRUONG XUAN DONG</p>
                                        <p class="mb-2"><strong>Số tiền:</strong> <?= number_format($totalAmount, 0, ',', '.') ?>đ</p>
                                        <p class="mb-2"><strong>Nội dung:</strong> <span id="momo-content">Thanh toán đơn hàng <?= time() ?></span></p>
                                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="copyToClipboard('momo-content')">
                                            <i class="fas fa-copy"></i> Sao chép
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Ghi chú:</label>
                        <textarea name="note" placeholder="Ghi chú về đơn hàng"></textarea>
                    </div>
                </form>
            </div>

            <!-- Thông tin đơn hàng -->
            <div class="order-summary">
                <div class="summary-header">
                    <h3>Thông tin đơn hàng</h3>
                </div>

                <div class="cart-items">
                    <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item">
                        <img src="<?= $item['image'] ?>" alt="<?= $item['title'] ?>">
                        <div class="item-info">
                            <h4><?= $item['title'] ?></h4>
                            <div class="item-details">
                                <span>Số lượng: <?= $item['quantity'] ?></span>
                                <span class="price"><?= number_format($item['price'], 0, ',', '.') ?>đ</span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <!-- Thêm input hidden cho mua ngay -->
                    <?php if (isset($_POST['buy_now'])): ?>
                        <input type="hidden" name="buy_now" value="1">
                        <input type="hidden" name="comic_id" value="<?= htmlspecialchars($_POST['comic_id']) ?>">
                        <input type="hidden" name="quantity" value="<?= htmlspecialchars($_POST['quantity']) ?>">
                        <input type="hidden" name="price" value="<?= htmlspecialchars($_POST['price']) ?>">
                    <?php endif; ?>
                </div>

                <div class="summary-footer">
                    <div class="subtotal">
                        <span>Tạm tính:</span>
                        <span><?= number_format($totalAmount, 0, ',', '.') ?>đ</span>
                    </div>
                    <div class="shipping">
                        <span>Phí vận chuyển:</span>
                        <span>Miễn phí</span>
                    </div>
                    <div class="total">
                        <span>Tổng cộng:</span>
                        <span class="total-amount"><?= number_format($totalAmount, 0, ',', '.') ?>đ</span>
                    </div>
                    <button type="submit" form="checkout-form" class="btn-checkout">
                        Đặt hàng (<?= number_format($totalAmount, 0, ',', '.') ?>đ)
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js"></script>
    <script>
        // Xử lý hiển thị form thẻ tín dụng
        document.getElementById('payment-method').addEventListener('change', function() {
            const creditCardForm = document.getElementById('credit-card-form');
            const bankingForm = document.getElementById('banking-form');
            const momoForm = document.getElementById('momo-form');
            
            // Ẩn tất cả form
            creditCardForm.style.display = 'none';
            bankingForm.style.display = 'none';
            momoForm.style.display = 'none';
            
            // Hiển thị form tương ứng
            switch(this.value) {
                case 'CREDIT':
                    creditCardForm.style.display = 'block';
                    break;
                case 'BANKING':
                    bankingForm.style.display = 'block';
                    break;
                case 'MOMO':
                    momoForm.style.display = 'block';
                    break;
            }
        });

        // Xử lý khi chọn ngân hàng
        document.getElementById('bank-select').addEventListener('change', function() {
            // Ẩn tất cả thông tin ngân hàng
            document.querySelectorAll('.bank-details').forEach(element => {
                element.style.display = 'none';
            });
            
            // Hiển thị thông tin ngân hàng được chọn
            if (this.value) {
                const selectedBank = document.getElementById(this.value + '-details');
                if (selectedBank) {
                    selectedBank.style.display = 'block';
                }
            }
        });

        // Hàm copy nội dung
        function copyToClipboard(elementId) {
            const content = document.getElementById(elementId).textContent;
            navigator.clipboard.writeText(content).then(() => {
                // Hiển thị thông báo đã copy
                const button = event.target.closest('button');
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check"></i> Đã sao chép';
                setTimeout(() => {
                    button.innerHTML = originalText;
                }, 2000);
            });
        }

        // Validate form trước khi submit
        document.getElementById('checkout-form').addEventListener('submit', function(e) {
            const paymentMethod = document.getElementById('payment-method').value;
            
            switch(paymentMethod) {
                case 'BANKING':
                    if (!document.getElementById('bank-select').value) {
                        e.preventDefault();
                        alert('Vui lòng chọn ngân hàng');
                        return;
                    }
                    break;
                    
                case 'MOMO':
                    // Có thể thêm validation cho MoMo nếu cần
                    break;
            }
        });

        // Format số thẻ
        document.getElementById('card-number').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/(.{4})/g, '$1 ').trim();
            e.target.value = value;
        });

        // Format ngày hết hạn
        document.getElementById('expiry-date').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.slice(0,2) + '/' + value.slice(2);
            }
            e.target.value = value;
        });

        // Validate form trước khi submit
        document.getElementById('checkout-form').addEventListener('submit', function(e) {
            const paymentMethod = document.getElementById('payment-method').value;
            
            if (paymentMethod === 'CREDIT') {
                const cardNumber = document.getElementById('card-number').value;
                const expiryDate = document.getElementById('expiry-date').value;
                const cvv = document.getElementById('cvv').value;
                const cardHolder = document.getElementById('card-holder').value;

                if (!cardNumber || !expiryDate || !cvv || !cardHolder) {
                    e.preventDefault();
                    alert('Vui lòng điền đầy đủ thông tin thẻ tín dụng');
                    return;
                }

                // Validate card number (Luhn algorithm)
                if (!validateCardNumber(cardNumber.replace(/\s/g, ''))) {
                    e.preventDefault();
                    alert('Số thẻ không hợp lệ');
                    return;
                }

                // Validate expiry date
                if (!validateExpiryDate(expiryDate)) {
                    e.preventDefault();
                    alert('Ngày hết hạn không hợp lệ');
                    return;
                }
            }
        });

        // Validate số thẻ using Luhn algorithm
        function validateCardNumber(number) {
            let sum = 0;
            let isEven = false;
            
            for (let i = number.length - 1; i >= 0; i--) {
                let digit = parseInt(number.charAt(i));
                
                if (isEven) {
                    digit *= 2;
                    if (digit > 9) {
                        digit -= 9;
                    }
                }
                
                sum += digit;
                isEven = !isEven;
            }
            
            return sum % 10 === 0;
        }

        // Validate ngày hết hạn
        function validateExpiryDate(expiry) {
            const [month, year] = expiry.split('/');
            const expDate = new Date(2000 + parseInt(year), parseInt(month) - 1);
            const today = new Date();
            return expDate > today;
        }

        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Thêm CSS cho phần bank-details
        const style = document.createElement('style');
        style.textContent = `
            .bank-details {
                width: 100%;
            }
            
            .bank-info {
                background-color: #f8f9fa;
                transition: all 0.3s ease;
            }
            
            .bank-info:hover {
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            }
            
            .account-details p {
                margin-bottom: 8px;
                font-size: 14px;
            }
            
            .btn-copy {
                transition: all 0.3s ease;
            }
            
            .btn-copy:hover {
                background-color: #e9ecef;
            }
            
            .bank-logo {
                max-height: 40px;
                object-fit: contain;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>