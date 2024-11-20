<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Trandy Products</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        <?php
        $count = 0;
        // Xáo trộn mảng sản phẩm ngẫu nhiên
        shuffle($sanphams);
        foreach ($sanphams as $sanpham):
            if ($count >= 8) break; // Dừng sau 8 sản phẩm
        ?>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <?php if (!empty($sanpham['sale_value'])): ?>
                            <div class="position-absolute bg-danger text-white p-1" style="top: 0; left: 0; font-size: 0.9rem; z-index: 1;">
                                <?php
                                if ($sanpham['sale_value'] < 100) {
                                    echo '-' . number_format($sanpham['sale_value'], 0) . '%';
                                } else {
                                    echo '-' . number_format($sanpham['sale_value'], 0, ',', '.') . ' đ';
                                }


                                ?>
                            </div>
                        <?php endif; ?>
                        <img class="img-fluid w-100" src="<?php echo $sanpham['image'] ?>" alt="" style="width: 50%; height: auto;">
                    </div>

                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3"><?php echo $sanpham['title'] ?></h6>
                        <div class="d-flex justify-content-center">
                            <h3>
                                <?php
                                $original_price = $sanpham['original_price'];
                                $final_price = $original_price;

                                // Kiểm tra giảm giá theo phần trăm hoặc giảm giá cố định
                                if (!empty($sanpham['sale_value']) && $sanpham['sale_value'] < 100) {
                                    // Giảm giá theo phần trăm
                                    $final_price -= ($original_price * $sanpham['sale_value'] / 100);
                                } elseif (!empty($sanpham['sale_value'])) {
                                    // Giảm giá theo số tiền cố định
                                    $final_price -= $sanpham['sale_value'];
                                }

                                echo number_format(max($final_price, 0), 0, ',', '.'); // Đảm bảo giá không âm
                                ?> đ
                            </h3>
                            <h6 class="text-muted ml-2"><del><?php echo number_format($sanpham['original_price'] ?? 0, 0, ',', '.') ?> đ </del></h6>

                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="?act=chitietsp&id=<?php echo $sanpham['id'] ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                    </div>
                </div>
            </div>
        <?php
            $count++;
        endforeach
        ?>

    </div>
    <!-- Products End -->
    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->





<!-- Offer Start -->
<div class="container-fluid offer pt-5">
    <div class="row px-xl-5">
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                <img src="img/offer-1.png" alt="">
                <div class="position-relative" style="z-index: 1;">
                    <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                    <h1 class="mb-4 font-weight-semi-bold">Spring Collection</h1>
                    <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                <img src="img/offer-2.png" alt="">
                <div class="position-relative" style="z-index: 1;">
                    <h5 class="text-uppercase text-primary mb-3">20% off the all order</h5>
                    <h1 class="mb-4 font-weight-semi-bold">Winter Collection</h1>
                    <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</div>







<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Trandy Products</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        <?php
        $count = 0;
        // Sắp xếp mảng $sanphams theo thời gian tạo giảm dần (mới nhất trước)
        usort($sanphams, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });
        foreach ($sanphams as $sanpham):
            if ($count >= 8) break; // Dừng sau 8 sản phẩm
        ?>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <?php if (!empty($sanpham['sale_value'])): ?>
                            <div class="position-absolute bg-danger text-white p-1" style="top: 0; left: 0; font-size: 0.9rem; z-index: 1;">
                                <?php
                                if ($sanpham['sale_value'] < 100) {
                                    echo '-' . number_format($sanpham['sale_value'], 0) . '%';
                                } else {
                                    echo '-' . number_format($sanpham['sale_value'], 0, ',', '.') . ' đ';
                                }


                                ?>
                            </div>
                        <?php endif; ?>
                        <img class="img-fluid w-100" src="<?php echo $sanpham['image'] ?>" alt="" style="width: 50%; height: auto;">
                    </div>

                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3"><?php echo $sanpham['title'] ?></h6>
                        <div class="d-flex justify-content-center">
                            <h3>
                                <?php
                                $original_price = $sanpham['original_price'];
                                $final_price = $original_price;

                                // Kiểm tra giảm giá theo phần trăm hoặc giảm giá cố định
                                if (!empty($sanpham['sale_value']) && $sanpham['sale_value'] < 100) {
                                    // Giảm giá theo phần trăm
                                    $final_price -= ($original_price * $sanpham['sale_value'] / 100);
                                } elseif (!empty($sanpham['sale_value'])) {
                                    // Giảm giá theo số tiền cố định
                                    $final_price -= $sanpham['sale_value'];
                                }

                                echo number_format(max($final_price, 0), 0, ',', '.'); // Đảm bảo giá không âm
                                ?> đ
                            </h3>
                            <h6 class="text-muted ml-2"><del><?php echo number_format($sanpham['original_price'] ?? 0, 0, ',', '.') ?> đ </del></h6>

                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="?act=chitietsp&id=<?php echo $sanpham['id'] ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                    </div>
                </div>
            </div>
        <?php
            $count++;
        endforeach
        ?>

    </div>
    <!-- Products End -->
    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div>
</div>