<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Our Shop</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="index.php">Home</a></p>
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
        <div class="col-lg-3 col-md-12 mb-4">
            <h5 class="font-weight-semi-bold mb-4">Filters</h5>
            <form method="GET" action="timkiem.php">
                <!-- Filter by Price -->
                <div class="border-bottom mb-4 pb-4">
                    <h6 class="font-weight-semi-bold mb-3">Filter by Price</h6>
                    <input type="number" name="price_min" class="form-control mb-3" placeholder="Min Price (VNĐ)" value="<?php echo htmlspecialchars($_GET['price_min'] ?? ''); ?>">
                    <input type="number" name="price_max" class="form-control mb-3" placeholder="Max Price (VNĐ)" value="<?php echo htmlspecialchars($_GET['price_max'] ?? ''); ?>">
                </div>

                <!-- Filter by Category -->
                <div class="border-bottom mb-4 pb-4">
                    <h6 class="font-weight-semi-bold mb-3">Category</h6>
                    <select name="category_id" class="form-control">
                        <option value="all" <?php echo (isset($_GET['category_id']) && $_GET['category_id'] === 'all') ? 'selected' : ''; ?>>All Categories</option>
                        <?php
                        $categories = [
                            "1" => "Tình cảm",
                            "2" => "Trinh thám",
                            "3" => "Siêu nhiên",
                            "4" => "Học đường",
                            "5" => "Thể thao",
                            "6" => "Fantasy",
                            "7" => "Kinh dị",
                            "8" => "Hành động",
                            "9" => "Phiêu lưu",
                            "10" => "Hài hước"
                        ];
                        foreach ($categories as $id => $label) : ?>
                            <option value="<?php echo $id; ?>" <?php echo (isset($_GET['category_id']) && $_GET['category_id'] == $id) ? 'selected' : ''; ?>>
                                <?php echo $label; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Search</button>
            </form>
        </div>
        <!-- Shop Sidebar End -->

        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <!-- Search Bar -->
                <form action="" class="w-50">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search by name">
                        <div class="input-group-append">
                            <button class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <!-- Sorting Dropdown -->
                <div class="dropdown ml-4">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
            <!-- Product Cards End -->

            <!-- Pagination Start -->
            <div class="col-12 pb-1">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mb-3">
                        <li class="page-item <?php echo ($page == 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?act=timkiem&page=<?php echo ($page - 1); ?>&q=<?php echo urlencode($query); ?>&price_min=<?php echo urlencode($price_min); ?>&price_max=<?php echo urlencode($price_max); ?>&category_id=<?php echo urlencode($category_id); ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>"><a class="page-link" href="?act=timkiem&page=<?php echo $i; ?>&q=<?php echo urlencode($query); ?>&price_min=<?php echo urlencode($price_min); ?>&price_max=<?php echo urlencode($price_max); ?>&category_id=<?php echo urlencode($category_id); ?>"><?php echo $i; ?></a></li>
                        <?php endfor; ?>
                        <li class="page-item <?php echo ($page == $totalPages) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?act=timkiem&page=<?php echo ($page + 1); ?>&q=<?php echo urlencode($query); ?>&price_min=<?php echo urlencode($price_min); ?>&price_max=<?php echo urlencode($price_max); ?>&category_id=<?php echo urlencode($category_id); ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
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
            <!-- Pagination End -->
        </div>
    </div>
</div>
<!-- Shop Product End -->
