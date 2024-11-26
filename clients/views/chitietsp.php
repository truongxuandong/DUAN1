<?php

if (!empty($sanphamct)): ?>
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner border">
                    <div class="carousel-item active">
                        <img class="w-100 h-100" src="<?= $sanphamct['image'] ?? '' ?>" alt="Image">
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
            <h3 class="font-weight-semi-bold mb-4 d-inline"><?= number_format($sanphamct['price'] ?? 0, 0, ',', '.') ?> đ</h3>
            <h5 class="font-weight-semi-bold mb-4 d-inline text-muted" style="text-decoration: line-through;"><?= number_format($sanphamct['original_price'] ?? 0, 0, ',', '.') ?> đ</h5>
            <p class="mb-4"><?= $sanphamct['description'] ?? '' ?></p>
            
            <form action="" method="POST" class="d-flex align-items-center mb-4 pt-2">
                <div class="input-group quantity mr-3" style="width: 130px;">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary btn-minus" onclick="decreaseValue()">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <input type="text" name="quantity" id="quantity" class="form-control bg-secondary text-center" value="1" min="1">
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
</div>
<?php if ($product): ?>
    <h2><?php echo htmlspecialchars($product['title']); ?></h2>
    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['title']); ?>" style="width: 300px; height: auto;">
    <p><strong>Mô tả:</strong> <?php echo htmlspecialchars($product['description']); ?></p>
    <p><strong>Giá:</strong> <?php echo number_format($product['price'], 0, ',', '.'); ?> đ</p>
<?php else: ?>
    <p>Sản phẩm không tồn tại.</p>
<?php endif; ?>



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
        if(value > 1) {
            value--;
            document.getElementById('quantity').value = value;
        }
    }
</script>
