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

<!-- Shop Content Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <!-- Sidebar Filters Start -->
        <div class="col-lg-3 col-md-12">
            <form method="GET" action="?act=timkiem">
                <!-- Filter by Price -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by Price</h5>
                    <input type="number" name="price_min" class="form-control mb-3" placeholder="Min Price (VNĐ)" value="<?php echo htmlspecialchars($_GET['price_min'] ?? ''); ?>">
                    <input type="number" name="price_max" class="form-control mb-3" placeholder="Max Price (VNĐ)" value="<?php echo htmlspecialchars($_GET['price_max'] ?? ''); ?>">
                </div>

                <!-- Filter by Category -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Category</h5>
                    <select name="category_id" class="form-control">
                        <option value="all" <?php echo (isset($_GET['category_id']) && $_GET['category_id'] === 'all') ? 'selected' : ''; ?>>All Categories</option>
                        <!-- Loop through categories dynamically -->
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

                <!-- Filter by Rating -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Rating</h5>
                    <select name="min_rating" class="form-control">
                        <option value="">All Ratings</option>
                        <option value="1" <?php echo (isset($_GET['min_rating']) && $_GET['min_rating'] == '1') ? 'selected' : ''; ?>>1 Star</option>
                        <option value="2" <?php echo (isset($_GET['min_rating']) && $_GET['min_rating'] == '2') ? 'selected' : ''; ?>>2 Stars</option>
                        <option value="3" <?php echo (isset($_GET['min_rating']) && $_GET['min_rating'] == '3') ? 'selected' : ''; ?>>3 Stars</option>
                        <option value="4" <?php echo (isset($_GET['min_rating']) && $_GET['min_rating'] == '4') ? 'selected' : ''; ?>>4 Stars</option>
                        <option value="5" <?php echo (isset($_GET['min_rating']) && $_GET['min_rating'] == '5') ? 'selected' : ''; ?>>5 Stars</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Search</button>
            </form>
        </div>
        <!-- Sidebar Filters End -->

        <!-- Product List Start -->
        <div class="col-lg-9 col-md-12">
            <div class="row pb-3">
                <?php if (!empty($products)) : ?>
                    <?php foreach ($products as $product) : ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 pb-4">
                            <div class="card product-item border-0 mb-4">
                                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100" src="<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image">
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3"><?php echo htmlspecialchars($product['title']); ?></h6>
                                    <div class="d-flex justify-content-center">
                                        <h6><?php echo number_format($product['price']); ?> VNĐ</h6>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="index.php?act=chitietsp&id=<?php echo urlencode($product['id']); ?>" class="btn btn-sm text-dark p-0">
                                        <i class="fas fa-eye text-primary mr-1"></i>View Detail
                                    </a>
                                    <a href="cart.php?add=<?php echo urlencode($product['id']); ?>" class="btn btn-sm text-dark p-0">
                                        <i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="text-center w-100">No products found!</p>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <div class="col-12 pb-1">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mb-3">
                        <li class="page-item <?php echo ($page == 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?act=timkiem&page=<?php echo ($page - 1); ?>&q=<?php echo urlencode($query); ?>&price_min=<?php echo urlencode($price_min); ?>&price_max=<?php echo urlencode($price_max); ?>&category_id=<?php echo urlencode($category_id); ?>&min_rating=<?php echo urlencode($min_rating); ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>"><a class="page-link" href="?act=timkiem&page=<?php echo $i; ?>&q=<?php echo urlencode($query); ?>&price_min=<?php echo urlencode($price_min); ?>&price_max=<?php echo urlencode($price_max); ?>&category_id=<?php echo urlencode($category_id); ?>&min_rating=<?php echo urlencode($min_rating); ?>"><?php echo $i; ?></a></li>
                        <?php endfor; ?>
                        <li class="page-item <?php echo ($page == $totalPages) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?act=timkiem&page=<?php echo ($page + 1); ?>&q=<?php echo urlencode($query); ?>&price_min=<?php echo urlencode($price_min); ?>&price_max=<?php echo urlencode($price_max); ?>&category_id=<?php echo urlencode($category_id); ?>&min_rating=<?php echo urlencode($min_rating); ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Product List End -->
    </div>
</div>
<!-- Shop Content End -->

