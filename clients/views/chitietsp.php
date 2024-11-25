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
            
            <div class="d-flex mb-3">
                <div class="text-primary mr-2">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star-half-alt"></small>
                    <small class="far fa-star"></small>
                </div>
                <small class="pt-1">(50 Reviews)</small>
            </div>
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
                    
                    <div class="selected-variant-info mt-3" style="display: none;">
                        <p class="mb-0">Còn: <span class="variant-stock"></span> sản phẩm</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <h3 class="font-weight-semi-bold d-inline" id="product-price">
                    <?php
                    if (!empty($sanphamct['sale_value'])) {
                        $original_price =  $sanphamct['price'];
                        $sale_value = $sanphamct['sale_value'];
                        
                        // Tính giá sau khuyến mãi
                        if ($sale_value < 100) {
                            // Giảm giá theo phần trăm
                            $final_price = $original_price - ($original_price * $sale_value / 100);
                        } else {
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
            
            <form action="" method="POST" class="d-flex align-items-center mb-4 pt-2">
                <div class="input-group quantity mr-3" style="width: 130px;">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary btn-minus" onclick="decreaseValue()">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <input type="number" name="quantity" id="quantity" class="form-control bg-secondary text-center" value="1" min="1">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary btn-plus" onclick="increaseValue()">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="product_id" value="<?= $sanphamct['id'] ?? '' ?>">
                <button type="submit" name="add_to_cart" class="btn btn-primary px-3">
                    <i class="fa fa-shopping-cart mr-1"></i> Add To Cart
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
                <h4 class="mb-4"><strong>Comments</strong></h4>
                <div class="media mb-4">
                    <img src="../assets/img/user.jpg" alt="User" class="img-fluid mr-3 mt-1" style="width: 45px;">
                    <div class="media-body">
                        <h6><strong>Jane Doe</strong><small> - <i>02 Feb 2045</i></small></h6>
                        <p><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Nulla pretium arcu nec lacus feugiat, vel euismod lacus fringilla.</p>
                    </div>
                </div>
                <form>
                    <div class="form-group">
                        <label for="comment"><strong>Leave a Comment</strong></label>
                        <textarea id="comment" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary px-3"><strong>Post Comment</strong></button>
                    </div>
                </form>
            </div>

            <!-- Reviews Section -->
            <div class="tab-pane fade" id="reviews-tab">
                <h4 class="mb-4"><strong>Reviews</strong></h4>
                <!-- Review Item -->
                <div class="media mb-4">
                    <img src="img/user.jpg" alt="User" class="img-fluid mr-3 mt-1" style="width: 45px;">
                    <div class="media-body">
                        <h6><strong>John Smith</strong><small> - <i>03 Mar 2045</i></small></h6>
                        <div class="text-primary mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <p><strong>Great product!</strong> Highly recommend to everyone looking for quality and reliability.</p>
                    </div>
                </div>
                <!-- Leave a Review -->
                <form>
                    <div class="form-group">
                        <label for="review-message"><strong>Your Review *</strong></label>
                        <textarea id="review-message" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="review-name"><strong>Name *</strong></label>
                        <input type="text" class="form-control" id="review-name">
                    </div>
                    <div class="form-group">
                        <label for="review-email"><strong>Email *</strong></label>
                        <input type="email" class="form-control" id="review-email">
                    </div>
                    <div class="form-group">
                        <p class="mb-1"><strong>Your Rating *</strong></p>
                        <div class="text-primary">
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary px-3"><strong>Submit Review</strong></button>
                    </div>
                </form>
            </div>
            
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
                   
                    <a href="" class="btn btn-sm text-dark p-0">
                        <i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart
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
        var value = parseInt(document.getElementById('quantity').value);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('quantity').value = value;
    }

    function decreaseValue() {
        var value = parseInt(document.getElementById('quantity').value);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            document.getElementById('quantity').value = value;
        }
    }
    function updateVariantInfo(button) {
        // Lấy các giá trị của biến thể được chọn
        var price = parseFloat(button.getAttribute('data-price'));
        var stock = button.getAttribute('data-stock');
        var image = button.getAttribute('data-image');
        var saleValue = parseFloat(button.getAttribute('data-sale-value') || 0);

        // Tính giá sau khi giảm giá
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
    }



    
</script>