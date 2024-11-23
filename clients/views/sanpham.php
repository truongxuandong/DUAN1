
  

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Our Shop</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Filter by price</h5> 
                <form> 
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3"> 
                        <input type="checkbox" class="custom-control-input" checked id="price-all"> 
                        <label class="custom-control-label" for="price-all">All Price</label>
                    </div> 
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3"> 
                        <input type="checkbox" class="custom-control-input" id="price-1"> 
                        <label class="custom-control-label" for="price-1">$0 - $100</label> 
                    </div> 
                </div>
                <!-- Price End -->
                
                <!-- the loai Start -->
                <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Filter by Category</h5>
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="category-all">
                        <label class="custom-control-label" for="category-all">All Categories</label>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="category-1">
                        <label class="custom-control-label" for="category-1">Action</label>
                    </div>
                </div>
                <!-- the loai End -->
                <!-- danh gia Start -->
                <div class="mb-5">
                <h5 class="font-weight-semi-bold mb-4">Filter by Review</h5>
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="rating-all" checked>
                        <label class="custom-control-label" for="rating-all">All Review</label>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="rating-1">
                        <label class="custom-control-label" for="rating-1">1 Star</label>
                    </div>
                </div>
                <!-- danh gia End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search by name">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <div class="dropdown ml-4">
                                <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                            Sort by
                                        </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Danh sách sản phẩm</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
    <?php
   

    // Loại bỏ các sản phẩm trùng lặp trước khi phân trang
    $unique_products = array();
    $displayed_ids = array();
    
    foreach ($listsp as $sp) {
        if (!in_array($sp['id'], $displayed_ids)) {
            $displayed_ids[] = $sp['id'];
            $unique_products[] = $sp;
        }
    }
    
    // Thêm logic phân trang với mảng đã lọc trùng
    $items_per_page = 6; // Đảm bảo hiển thị đúng 6 sản phẩm mỗi trang
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $total_items = count($unique_products);
    $total_pages = ceil($total_items / $items_per_page);
    $offset = ($current_page - 1) * $items_per_page;

    // Lấy chính xác 6 sản phẩm cho trang hiện tại
    $current_products = array_slice($unique_products, $offset, $items_per_page);
    
    foreach ($current_products as $sp):
    ?>
        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <?php if (!empty($sp['sale_value'])): ?>
                        <div class="position-absolute bg-danger text-white p-1" style="top: 0; left: 0; font-size: 0.9rem; z-index: 1;">
                            <?php
                            if ($sp['sale_value'] < 100) {
                                echo '-' . number_format($sp['sale_value'], 0) . '%';
                            } else {
                                echo '-' . number_format($sp['sale_value'], 0, ',', '.') . ' đ';
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                    <img class="img-fluid w-100" src="<?php echo $sp['image'] ?>" alt="">
                </div>

                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3"><?php echo $sp['title'] ?></h6>
                    <div class="d-flex justify-content-center">
                        <h3 style="font-size: 20px;">
                            <?php
                            $original_price = $sp['original_price'];
                            $final_price = $original_price;

                            // Kiểm tra giảm giá theo phần trăm hoặc giảm giá cố định
                            if (!empty($sp['sale_value']) && $sp['sale_value'] < 100) {
                                // Giảm giá theo phần trăm
                                $final_price -= ($original_price * $sp['sale_value'] / 100);
                            } elseif (!empty($sp['sale_value'])) {
                                // Giảm giá theo số tiền cố định
                                $final_price -= $sp['sale_value'];
                            }

                            echo number_format(max($final_price, 0), 0, ',', '.'); // Đảm bảo giá không âm
                            ?> đ
                        </h3>
                        <?php if (!empty($sp['sale_value'])): ?>
                            <h6 class="text-muted ml-2"><del><?php echo number_format($original_price, 0, ',', '.') ?> đ </del></h6>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="?act=chitietsp&id=<?php echo $sp['id'] ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

    <!-- Products End -->
                    
                    <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mb-3">
                                <li class="page-item <?php echo ($current_page <= 1) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?act=sanpham&page=<?php echo $current_page - 1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?php echo ($current_page == $i) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?act=sanpham&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                                <li class="page-item <?php echo ($current_page >= $total_pages) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?act=sanpham&page=<?php echo $current_page + 1; ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

