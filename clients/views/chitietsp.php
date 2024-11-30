
<?php

if (!empty($sanphamct)): ?>
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner border">
                    <div class="carousel-item active">
                        <img id="product-image" class="w-100 h-100" src="<?= $sanphamct['image'] ?? '' ?>" alt="Image">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7 pb-5">
            <h3 class="font-weight-semi-bold"><?= $sanphamct['title'] ?? '' ?></h3>
            <!-- // -->
            <?php
// Kiểm tra nếu có đánh giá thực tế từ cơ sở dữ liệu và comic_id trùng với id của sản phẩm
if (!empty($danhgias)) {
    // Tính tổng số đánh giá chỉ với comic_id == sanphamct['id']
    $filteredDanhgias = array_filter($danhgias, function($danhgia) use ($sanphamct) {
        return $danhgia['comic_id'] == $sanphamct['id'];
    });

    // Kiểm tra nếu có đánh giá phù hợp
    if (!empty($filteredDanhgias)) {
        // Tính tổng số đánh giá
        $tongSoDanhGia = count($filteredDanhgias);

        // Tính tổng số sao
        $tongSoSao = 0;
        foreach ($filteredDanhgias as $danhgia) {
            $tongSoSao += getRatingStars($danhgia['rating']);
        }

        // Tính số sao trung bình
        $soSaoTrungBinh = $tongSoSao / $tongSoDanhGia;

        ?>
        <div>
            <p>Đánh giá (<?= $tongSoDanhGia ?>): <?php
                $fullStars = floor($soSaoTrungBinh); // Số sao đầy
                $halfStar = ($soSaoTrungBinh - $fullStars >= 0.5) ? 1 : 0; // Kiểm tra sao nửa
                $emptyStars = 5 - $fullStars - $halfStar; // Số sao trống

                // Hiển thị sao vàng đầy
                for ($i = 0; $i < $fullStars; $i++) {
                    echo '<i class="fas fa-star text-warning"></i>';
                }

                // Hiển thị sao nửa
                if ($halfStar) {
                    echo '<i class="fas fa-star-half-alt text-warning"></i>';
                }

                // Hiển thị sao trống
                for ($i = 0; $i < $emptyStars; $i++) {
                    echo '<i class="far fa-star text-warning"></i>';
                }
            ?></p>
        </div>
    <?php
    } else {
        echo '<p>Chưa có đánh giá nào cho sản phẩm này.</p>';
    }
} else {
    echo '<p>Chưa có đánh giá nào.</p>';
}
?>







            <div class="product-details mb-4">
                <?php if (!empty($sanphamct['variants'])): ?>
                    <div class="variants-container">
                        <?php foreach ($sanphamct['variants'] as $variant): ?>

                            <button class="btn btn-outline-primary variant-btn"
                                data-price="<?= $variant['price'] ?>"
                                data-stock="<?= $variant['stock_quantity'] ?>"
                                data-image="<?= $variant['image'] ?>"
                                data-format="<?= $variant['format'] ?>"
                                data-language="<?= $variant['language'] ?>"
                                data-sale-value="<?= $variant['sale_value'] ?>"
                                onclick="updateVariantInfo(this)">
                                <?= $variant['format'] ?> + <?= $variant['language'] ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                    
                 <?php endif; ?>
            </div>
            <p class="mb-4" id="stock-display">Còn : <?= $sanphamct['stock_quantity'] ?? '' ?> sản phẩm</p>


            <div class="mb-4">
                <h3 class="font-weight-semi-bold d-inline" id="product-price">
                    <?php
                    if (!empty($sanphamct['sale_value'])) {
                        $original_price =  $sanphamct['price'];
                        $sale_value = $sanphamct['sale_value'];

                        // Tính giá sau khuyến mãi
                        if ($sale_value < 100) {
                            // Giảm giá theo phần trăm
                            $final_price = $original_price - ($original_price * $sale_value / 100);} 
                            else {
                            // Giảm giá theo số tiền cố định
                            $final_price = $original_price - $sale_value;
                        }
                        echo number_format(max($final_price, 0), 0, ',', '.') . ' đ';
                    } else {
                        // Không có khuyến mãi, hiển thị giá gốc
                        echo number_format($sanphamct['price'] ?? 0, 0, ',', '.') . ' đ';
                    }
                    ?>
                </h3>
                <?php if (!empty($sanphamct['sale_value'])): ?>
                    <h5 class="font-weight-semi-bold d-inline text-muted ml-2" id="original-price" style="text-decoration: line-through;">
                        <?= number_format($sanphamct['original_price'] ?? $sanphamct['price'], 0, ',', '.') ?> đ
                    </h5>
                <?php endif; ?>

            </div>
            <p class="mb-4"><?= $sanphamct['description'] ?? '' ?></p>

            <form action="?act=add-item-to-cart" method="POST" class="d-flex align-items-center mb-4 pt-2">
                <!-- ID sản phẩm hoặc biến thể -->
                <input type="hidden" name="variant_id" value="<?= htmlspecialchars($sanphamct['id'] ?? '') ?>">
                <input type="hidden" name="comic_id" value="<?= htmlspecialchars($sanphamct['comic_id'] ?? $sanphamct['id'] ?? '') ?>">

                <?php if (($sanphamct['stock_quantity'] ?? 0) > 0): ?>
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-minus" onclick="decreaseValue()">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" name="quantity" id="quantity" class="form-control bg-secondary text-center"
                            style="padding: 10px;" value="1" min="1" max="<?= (int) $sanphamct['stock_quantity'] ?>">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-plus" onclick="increaseValue()">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" name="view-shopping-cart" class="btn btn-primary px-3">
                        <i class="fa fa-shopping-cart mr-1"></i> Add To Cart
                    </button>
                <?php else: ?>
                    <div class="alert alert-warning mb-0">Out of stock</div>
                <?php endif; ?>
            </form>
                <form action="?act=checkout" method="POST" style="display: inline;" onsubmit="return validateBeforeCheckout()">
                    <input type="hidden" name="buy_now" value="1">
                    <input type="hidden" name="comic_id" value="<?= htmlspecialchars($sanphamct['id'] ?? '') ?>">
                    <input type="hidden" name="quantity" id="buy_now_quantity" value="1">
                    <input type="hidden" name="price" value="<?= htmlspecialchars($final_price ?? $sanphamct['price'] ?? '') ?>">
                    <input type="hidden" name="title" value="<?= htmlspecialchars($sanphamct['title'] ?? '') ?>">
                    <input type="hidden" name="image" value="<?= htmlspecialchars($sanphamct['image'] ?? '') ?>">
                    <button type="submit" class="btn btn-danger px-3 ml-2">
                        <i class="fa fa-flash mr-1"></i> Mua ngay
                    </button>
                </form>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-warning">No product details available.</div>
<?php endif; ?>

<div class="d-flex pt-2">
    <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
    <div class="d-inline-flex">
        <a class="text-dark px-2" href="">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a class="text-dark px-2" href="">
            <i class="fab fa-twitter"></i>
        </a>
        <a class="text-dark px-2" href="">
            <i class="fab fa-linkedin-in"></i>
        </a>
        <a class="text-dark px-2" href="">
            <i class="fab fa-pinterest"></i>
        </a>
    </div>
</div>

<div class="row px-xl-5">
    <div class="col">
        <!-- Tabs for Comments and Reviews -->
        <div class="nav nav-tabs justify-content-center border-secondary mb-4">
            <a class="nav-item nav-link active" data-toggle="tab" href="#comments-tab"><strong>Comments</strong></a>
            <a class="nav-item nav-link" data-toggle="tab" href="#reviews-tab"><strong>Reviews</strong></a>
        </div>
        
        <div class="tab-content">
            <!-- Comments Section -->
            <div class="tab-pane fade show active" id="comments-tab">
            <div class="row">
    <!-- Cột bên trái: Danh sách bình luận -->
    <div class="col-md-6">
    <h4 class="mb-6">Danh sách bình luận và giá về sản phẩm</h4>

    <?php 
    $comments_shown = 0; // Biến đếm số lượng bình luận đã hiển thị
    $has_comments = false; // Khởi tạo biến kiểm tra có bình luận hay không
    ?>

    <div id="comment-list">
        <?php foreach ($binhluans as $key => $binhluan): ?>
            <?php if ($binhluan['comics_id'] == $sanphamct['id']): ?>
                <?php $has_comments = true; ?>
                <div class="media mb-4 pl-3 comment-item" style="display: <?= $comments_shown < 5 ? 'block' : 'none'; ?>; flex-direction: column; border-bottom: 1px solid #ddd;">
                    <div class="media-body">
                        <h6><span><?= $binhluan['name'] ?: 'Khách' ?></span><small> - <i><?= $binhluan['Create_at'] ?></i></small></h6>
                        <p><span>Nội dung: <?= $binhluan['Content'] ?></span></p>
                    </div>
                </div>
                <?php $comments_shown++; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <?php if (!$has_comments): ?>
        <p>Sản phẩm chưa được comment.</p>
    <?php elseif ($comments_shown > 5): ?>
        <div class="btn-group mt-3">
            <button id="load-more-comments" class="btn btn-primary">Xem thêm</button>
            <button id="close-comments" class="btn btn-secondary" style="display: none;">Đóng</button>
        </div>
    <?php endif; ?>
</div>


    <!-- Cột bên phải: Form thêm bình luận -->
    <div class="col-md-6">
    <h4 class="mb-3">Thêm bình luận mới</h4>

    <form action="<?= '?act=add-binh-luan&id=' . $sanphamct['id'] ?>" method="POST"> <!-- Trỏ đến file xử lý -->
    <div class="form-group">
        <label for="Content">Nội dung bình luận:</label>
        <textarea name="Content" id="Content" class="form-control" rows="4" placeholder="Nhập nội dung bình luận..." required></textarea>
    </div>
    <!-- ID người dùng (ẩn, lấy từ phiên đăng nhập) -->
    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">

    <!-- ID sản phẩm (ẩn) -->
    <input type="hidden" name="comics_id" value="<?= $sanphamct['id'] ?>"> 
    <button type="submit" class="btn btn-primary">Gửi bình luận</button>
</form>


</div>
</div>

            </div>
            
          <!-- Reviews Section -->
<div class="tab-pane fade" id="reviews-tab">
    <div class="col-md-12">
        <h4 style="margin-bottom: 1.5rem; color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 0.5rem; font-weight: bold; text-transform: uppercase;">
            Danh sách đánh giá về sản phẩm
        </h4>

        <?php
// Định nghĩa hàm getRatingStars() bên ngoài vòng lặp
function getRatingStars($ratingText) {
    $ratings = [
        'very_bad' => 1,
        'bad' => 2,
        'average' => 3,
        'good' => 4,
        'excellent' => 5,
    ];
    return $ratings[$ratingText] ?? 0;
}
?>

<?php foreach ($danhgias as $key => $danhgia): ?>
    <?php if($sanphamct['id']==$danhgia['comic_id']): ?>
    <!-- <?php var_dump($danhgia);?> -->
    <div class="media" style="margin-bottom: 15px; padding: 15px; border: 1px solid #ddd; border-radius: 8px; background: #f9f9f9; transition: all 0.3s ease;">
        <div class="media-body">
            <!-- Tên người đánh giá -->
            <h6 style="margin-bottom: 0.5rem;">
                <strong><?= $danhgia['name'] ?: 'Khách' ?></strong>
                <small style="color: #999;"> - <i><?= date('d/m/Y', strtotime($danhgia['created_at'])) ?></i></small>
            </h6>

            <!-- Đánh giá bằng sao -->
            <div style="margin-bottom: 0.75rem;">
                <?php 
                $danhgia_text = $danhgia['rating'];
                $rating = getRatingStars($danhgia_text);
                ?>
                <span style="color: gold;">
                    <?php 
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $rating) {
                            echo '<i class="fa fa-star" style="font-size: 16px; margin-right: 2px;"></i>';
                        } else {
                            echo '<i class="fa fa-star-o" style="font-size: 16px; margin-right: 2px;"></i>';
                        }
                    }
                    ?>
                </span>
                <span style="color: #999;">(<?= ucfirst($danhgia['rating']) ?>)</span>
            </div>

            <!-- Nội dung đánh giá -->
            <p style="margin: 0; font-size: 14px; line-height: 1.6; color: #333;">Nội dung:
                <?= htmlspecialchars($danhgia['review_text']) ?>
            </p>
        </div>
    </div>
<?php endif; ?>
<?php endforeach; ?>

    </div>
</div>

    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Sách cùng thể loại</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            <?php
            $count = 0;
            $displayed_products = array();

            foreach ($sanphamcungloai as $spcl):
                // Skip if already displayed or if count reaches 5
                if (in_array($spcl['id'], $displayed_products) || $count >= 5) continue;
                $displayed_products[] = $spcl['id'];
                $count++;
            ?>
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <?php if (!empty($spcl['sale_value'])): ?>
                                <div class="position-absolute bg-danger text-white p-1" style="top: 0; left: 0; font-size: 0.9rem; z-index: 1;">
                                    <?php
                                    if ($spcl['sale_value'] < 100) {
                                        echo '-' . number_format($spcl['sale_value'], 0) . '%';
                                    } else {
                                        echo '-' . number_format($spcl['sale_value'], 0, ',', '.') . ' đ';
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>
                            <img class="img-fluid w-100" src="<?php echo $spcl['image'] ?>" alt="" style="width: 50%; height: auto;">
                        </div>

                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3"><?php echo $spcl['title'] ?></h6>

                            <div class="d-flex justify-content-center">
                                <h5 class="small-price">
                                    <?php
                                    $original_price = $spcl['price'];
                                    $final_price = $original_price;
                                    $has_discount = false;

                                    // Kiểm tra giảm giá theo phần trăm hoặc giảm giá cố định
                                    if (!empty($spcl['sale_value'])) {
                                        $has_discount = true;
                                        if ($spcl['sale_value'] < 100) {
                                            // Giảm giá theo phần trăm
                                            $final_price -= ($original_price * $spcl['sale_value'] / 100);
                                        } else {
                                            // Giảm giá theo số tiền cố định
                                            $final_price -= $spcl['sale_value'];
                                        }
                                    }

                                    echo number_format(max($final_price, 0), 0, ',', '.'); // Đảm bảo giá không âm
                                    ?> đ
                                </h5>
                                <?php if ($has_discount): ?>
                                    <h6 class="text-muted ml-2"><del><?php echo number_format($original_price, 0, ',', '.') ?> đ</del></h6>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="?act=chitietsp&id=<?php echo $spcl['id'] ?>" class="btn btn-sm text-dark p-0">
                                 <i class="fas fa-eye text-primary mr-1"></i>View Detail
                            </a>


                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php if ($count == 0): ?>
                <div class="col-12 text-center">Không có sản phẩm cùng loại</div>
            <?php endif; ?>
        </div>
    </div>


    <script>
        function increaseValue() {
    var input = document.getElementById('quantity');
    var max = parseInt(input.getAttribute('max'));
    var value = parseInt(input.value);

    if (value < max) {
        input.value = value + 1;
    }
}

function decreaseValue() {
    var input = document.getElementById('quantity');
    var value = parseInt(input.value);

    if (value > 1) {
        input.value = value - 1;
    }
}

// Thêm validation khi người dùng nhập trực tiếp
document.getElementById('quantity').addEventListener('change', function () {
    var value = parseInt(this.value);
    var max = parseInt(this.getAttribute('max'));

    if (isNaN(value) || value < 1) {
        this.value = 1;
    } else if (value > max) {
        this.value = max;
    }
});

function updateVariantInfo(button) {
    // Lấy các giá trị từ data-* của nút
    var price = parseFloat(button.getAttribute('data-price'));
    var stock = parseInt(button.getAttribute('data-stock'));
    var image = button.getAttribute('data-image');
    var saleValue = parseFloat(button.getAttribute('data-sale-value') || 0);

    // Kiểm tra các giá trị đã được lấy đúng chưa
    console.log('Price:', price, 'Stock:', stock, 'Image:', image, 'Sale Value:', saleValue);

    // Tính giá sau giảm giá nếu có
    var finalPrice = price;
    if (saleValue > 0) {
        if (saleValue < 100) {
            // Giảm giá theo phần trăm
            finalPrice = price - (price * saleValue / 100);
        } else {
            // Giảm giá theo số tiền cố định
            finalPrice = price - saleValue;
        }
    }

    // Cập nhật giá hiển thị
    document.getElementById('product-price').textContent =
        new Intl.NumberFormat('vi-VN').format(Math.max(finalPrice, 0)) + ' đ';

    // Cập nhật số lượng tồn kho
    var stockDisplay = document.getElementById('stock-display');
    stockDisplay.textContent = `Còn : ${stock} sản phẩm`;

    // Cập nhật hình ảnh sản phẩm
    document.getElementById('product-image').src = image ? image : '';

    // Cập nhật số lượng tối đa (max) cho input số lượng
    var quantityInput = document.getElementById('quantity');
    quantityInput.setAttribute('max', stock);
    quantityInput.value = Math.min(quantityInput.value, stock);

    // Cập nhật giá trị số lượng "mua ngay"
    document.getElementById('buy_now_quantity').value = Math.min(1, stock);
}


function validateBeforeCheckout() {
    // Kiểm tra đăng nhập
    <?php if (!isset($_SESSION['user'])): ?>
        Swal.fire({
            title: 'Thông báo',
            text: 'Vui lòng đăng nhập để mua hàng!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Đăng nhập',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'index.php?act=login';
            }
        });
        return false;
    <?php endif; ?>

    // Kiểm tra số lượng tồn kho
    const quantity = parseInt(document.getElementById('quantity').value);
    const stock = parseInt(document.getElementById('quantity').getAttribute('max'));

    if (quantity > stock) {
        Swal.fire({
            title: 'Lỗi',
            text: 'Số lượng vượt quá tồn kho!',
            icon: 'error'
        });
        return false;
    }

    // Cập nhật số lượng cho form mua ngay
    document.getElementById('buy_now_quantity').value = quantity;
    return true;
}

            // Hiển thị giá gốc nếu có giảm giá
            if (saleValue > 0) {
                document.getElementById('original-price').style.display = 'inline';
                document.getElementById('original-price').textContent =
                    new Intl.NumberFormat('vi-VN').format(price) + ' đ';
            } else {
                document.getElementById('original-price').style.display = 'none';
            }

            // Cập nhật số lượng tồn kho
            document.querySelector('.variant-stock').textContent = stock ? stock : '0';

            // Cập nhật hình ảnh
            document.getElementById('product-image').src = image ? image : '';

            // Cập nhật thông tin biến thể đã chọn
            document.querySelector('.selected-variant-info').style.display = 'block';
        

        function validateBeforeCheckout() {
            // Kiểm tra đăng nhập
            <?php if (!isset($_SESSION['user'])): ?>
                Swal.fire({
                    title: 'Thông báo',
                    text: 'Vui lòng đăng nhập để mua hàng!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Đăng nhập',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'index.php?act=login';
                    }
                });
                return false;
            <?php endif; ?>

            // Kiểm tra số lượng tồn kho
            const quantity = parseInt(document.getElementById('quantity').value);
            const stock = parseInt('<?= $sanphamct['stock_quantity'] ?? 0 ?>');
            
            if (quantity > stock) {
                Swal.fire({
                    title: 'Lỗi',
                    text: 'Số lượng vượt quá tồn kho!',
                    icon: 'error'
                });
                return false;
            }
            
            // Cập nhật số lượng cho form mua ngay
            document.getElementById('buy_now_quantity').value = quantity;
            return true;
        }
        //
        document.addEventListener("DOMContentLoaded", function () {
        const loadMoreBtn = document.getElementById("load-more-comments");
        const closeCommentsBtn = document.getElementById("close-comments");
        const commentItems = document.querySelectorAll(".comment-item");
        let visibleCount = 5;

        if (loadMoreBtn) {
            loadMoreBtn.addEventListener("click", function () {
                // Hiển thị các bình luận tiếp theo
                for (let i = visibleCount; i < visibleCount + 5; i++) {
                    if (commentItems[i]) {
                        commentItems[i].style.display = "block";
                    }
                }
                visibleCount += 5;

                // Hiển thị nút "Đóng" khi có nhiều hơn 5 bình luận
                if (visibleCount > 5) {
                    closeCommentsBtn.style.display = "inline-block";
                }

                // Ẩn nút "Xem thêm" nếu không còn bình luận
                if (visibleCount >= commentItems.length) {
                    loadMoreBtn.style.display = "none";
                }
            });
        }

        if (closeCommentsBtn) {
            closeCommentsBtn.addEventListener("click", function () {
                // Ẩn các bình luận và chỉ hiển thị 5 bình luận đầu
                for (let i = 5; i < commentItems.length; i++) {
                    commentItems[i].style.display = "none";
                }
                visibleCount = 5;

                // Hiển thị lại nút "Xem thêm" và ẩn nút "Đóng"
                loadMoreBtn.style.display = "inline-block";
                closeCommentsBtn.style.display = "none";
            });
        }
    });
    function increaseValue() {
        var value = parseInt(document.getElementById('quantity').value);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('quantity').value = value;
    }

    function decreaseValue() {
        var value = parseInt(document.getElementById('quantity').value);
        value = isNaN(value) ? 0 : value;
        if(value > 1) {
            value--;
            document.getElementById('quantity').value = value;
        }
    }
    </script>
    <style>
        .text-warning {
    color: gold; /* Màu vàng cho biểu tượng sao */
}
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
